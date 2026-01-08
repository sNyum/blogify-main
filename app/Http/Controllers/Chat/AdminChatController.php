<?php

namespace App\Http\Controllers\Chat;

use App\Events\ConversationAssigned;
use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Http\Controllers\Controller;
use App\Models\CannedResponse;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminChatController extends Controller
{
    /**
     * Get open conversations.
     */
    public function getOpenConversations(Request $request)
    {
        $conversations = ChatConversation::whereIn('status', ['open', 'assigned'])
            ->with(['externalUser', 'assignedAdmin', 'latestMessage'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($conversation) {
                return [
                    'id' => $conversation->id,
                    'user_name' => $conversation->externalUser->name,
                    'user_organization' => $conversation->externalUser->organization,
                    'subject' => $conversation->subject,
                    'status' => $conversation->status,
                    'priority' => $conversation->priority,
                    'assigned_admin' => $conversation->assignedAdmin?->name,
                    'assigned_admin_id' => $conversation->assigned_admin_id,
                    'latest_message' => $conversation->latestMessage?->content,
                    'unread_count' => $conversation->messages()->where('is_read', false)->where('sender_type', 'user')->count(),
                    'created_at' => $conversation->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'success' => true,
            'conversations' => $conversations,
        ]);
    }

    /**
     * Get conversations assigned to current admin.
     */
    public function getMyConversations(Request $request)
    {
        $admin = $request->user();

        $conversations = ChatConversation::where('assigned_admin_id', $admin->id)
            ->whereIn('status', ['assigned'])
            ->with(['externalUser', 'latestMessage'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($conversation) {
                return [
                    'id' => $conversation->id,
                    'user_name' => $conversation->externalUser->name,
                    'user_organization' => $conversation->externalUser->organization,
                    'subject' => $conversation->subject,
                    'status' => $conversation->status,
                    'priority' => $conversation->priority,
                    'latest_message' => $conversation->latestMessage?->content,
                    'unread_count' => $conversation->messages()->where('is_read', false)->where('sender_type', 'user')->count(),
                    'created_at' => $conversation->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'success' => true,
            'conversations' => $conversations,
        ]);
    }

    /**
     * Get messages for a conversation.
     */
    public function getMessages(Request $request, $conversationId)
    {
        $conversation = ChatConversation::findOrFail($conversationId);

        $messages = ChatMessage::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'sender_type' => $message->sender_type,
                    'sender_id' => $message->sender_id,
                    'message_type' => $message->message_type,
                    'content' => $message->content,
                    'file_path' => $message->file_path,
                    'file_name' => $message->file_name,
                    'file_size' => $message->formatted_file_size,
                    'file_url' => $message->file_url,
                    'is_read' => $message->is_read,
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            });

        // Mark user messages as read
        ChatMessage::where('conversation_id', $conversationId)
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json([
            'success' => true,
            'conversation' => $conversation->load('externalUser.profile'),
            'messages' => $messages,
        ]);
    }

    /**
     * Assign conversation to current admin.
     */
    public function assignToMe(Request $request, $conversationId)
    {
        $admin = $request->user();

        $conversation = ChatConversation::findOrFail($conversationId);

        $conversation->assignToAdmin($admin->id);

        // Create system message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => 0,
            'message_type' => 'system',
            'content' => $admin->name . ' telah mengambil percakapan ini.',
        ]);

        // Broadcast assignment
        broadcast(new ConversationAssigned($conversation->fresh()))->toOthers();
        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json([
            'success' => true,
            'conversation' => $conversation->fresh(),
        ]);
    }

    /**
     * Send message as admin.
     */
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:chat_conversations,id',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = $request->user();

        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Create message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
            'message_type' => 'text',
            'content' => $request->message,
        ]);

        // Broadcast message
        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 201);
    }

    /**
     * Upload file as admin.
     */
    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:chat_conversations,id',
            'file' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = $request->user();

        $conversation = ChatConversation::findOrFail($request->conversation_id);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('chat-files', $fileName, 'public');

        // Determine message type
        $messageType = 'file';
        $mimeType = $file->getMimeType();
        if (str_starts_with($mimeType, 'image/')) {
            $messageType = 'image';
        }

        // Create message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
            'message_type' => $messageType,
            'content' => 'File: ' . $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
        ]);

        // Broadcast message
        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 201);
    }

    /**
     * Send canned response.
     */
    public function sendCannedResponse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:chat_conversations,id',
            'canned_response_id' => 'required|exists:canned_responses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = $request->user();

        $conversation = ChatConversation::findOrFail($request->conversation_id);
        $cannedResponse = CannedResponse::findOrFail($request->canned_response_id);

        // Increment usage count
        $cannedResponse->incrementUsage();

        // Create message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
            'message_type' => 'text',
            'content' => $cannedResponse->content,
        ]);

        // Broadcast message
        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 201);
    }

    /**
     * Close conversation.
     */
    public function closeConversation(Request $request, $conversationId)
    {
        $admin = $request->user();

        $conversation = ChatConversation::findOrFail($conversationId);

        $conversation->close();

        // Create system message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => 0,
            'message_type' => 'system',
            'content' => 'Percakapan ditutup oleh ' . $admin->name . '.',
        ]);

        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json([
            'success' => true,
            'message' => 'Conversation closed.',
        ]);
    }

    /**
     * Get chat statistics.
     */
    public function getStatistics(Request $request)
    {
        $stats = [
            'total_conversations' => ChatConversation::count(),
            'open_conversations' => ChatConversation::where('status', 'open')->count(),
            'assigned_conversations' => ChatConversation::where('status', 'assigned')->count(),
            'closed_conversations' => ChatConversation::where('status', 'closed')->count(),
            'average_rating' => ChatConversation::whereNotNull('rating')->avg('rating'),
            'total_messages' => ChatMessage::count(),
            'conversations_today' => ChatConversation::whereDate('created_at', today())->count(),
            'conversations_this_week' => ChatConversation::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'conversations_this_month' => ChatConversation::whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json([
            'success' => true,
            'statistics' => $stats,
        ]);
    }

    /**
     * Get canned responses.
     */
    public function getCannedResponses(Request $request)
    {
        $responses = CannedResponse::active()->orderBy('title')->get();

        return response()->json([
            'success' => true,
            'canned_responses' => $responses,
        ]);
    }

    /**
     * Broadcast typing event.
     */
    public function typing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:chat_conversations,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = $request->user();

        $conversation = ChatConversation::findOrFail($request->conversation_id);

        broadcast(new UserTyping($conversation, 'admin', $admin->id, $admin->name))->toOthers();

        return response()->json(['success' => true]);
    }
}
