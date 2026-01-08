<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Events\NewConversation;
use App\Events\UserTyping;
use App\Http\Controllers\Controller;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Show chat page.
     */
    public function index()
    {
        return view('user.chat');
    }

    /**
     * Start a new conversation.
     */
    public function startConversation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'priority' => 'sometimes|in:low,normal,high',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Create conversation
        $conversation = ChatConversation::create([
            'external_user_id' => $user->id,
            'subject' => $request->subject ?? 'Chat dengan BPS',
            'priority' => $request->priority ?? 'normal',
            'status' => 'open',
        ]);

        // Create first message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'user',
            'sender_id' => $user->id,
            'message_type' => 'text',
            'content' => $request->message,
        ]);

        // Broadcast new conversation to admins
        broadcast(new NewConversation($conversation))->toOthers();

        // Broadcast message
        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json([
            'success' => true,
            'conversation' => $conversation,
            'message' => $message,
        ], 201);
    }

    /**
     * Get all conversations for authenticated user.
     */
    public function getConversations(Request $request)
    {
        $user = $request->user();

        $conversations = ChatConversation::where('external_user_id', $user->id)
            ->with(['latestMessage', 'assignedAdmin'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($conversation) {
                return [
                    'id' => $conversation->id,
                    'subject' => $conversation->subject,
                    'status' => $conversation->status,
                    'priority' => $conversation->priority,
                    'assigned_admin' => $conversation->assignedAdmin?->name,
                    'latest_message' => $conversation->latestMessage?->content,
                    'unread_count' => $conversation->messages()->where('is_read', false)->where('sender_type', 'admin')->count(),
                    'created_at' => $conversation->created_at->toIso8601String(),
                    'updated_at' => $conversation->updated_at->toIso8601String(),
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
        $user = $request->user();

        $conversation = ChatConversation::where('id', $conversationId)
            ->where('external_user_id', $user->id)
            ->firstOrFail();

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

        // Mark admin messages as read
        ChatMessage::where('conversation_id', $conversationId)
            ->where('sender_type', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json([
            'success' => true,
            'conversation' => $conversation,
            'messages' => $messages,
        ]);
    }

    /**
     * Send a message.
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

        $user = $request->user();

        // Verify conversation belongs to user
        $conversation = ChatConversation::where('id', $request->conversation_id)
            ->where('external_user_id', $user->id)
            ->firstOrFail();

        // Create message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'user',
            'sender_id' => $user->id,
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
     * Upload file.
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

        $user = $request->user();

        // Verify conversation belongs to user
        $conversation = ChatConversation::where('id', $request->conversation_id)
            ->where('external_user_id', $user->id)
            ->firstOrFail();

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
            'sender_type' => 'user',
            'sender_id' => $user->id,
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
     * Mark message as read.
     */
    public function markAsRead(Request $request, $messageId)
    {
        $user = $request->user();

        $message = ChatMessage::findOrFail($messageId);

        // Verify user owns the conversation
        $conversation = ChatConversation::where('id', $message->conversation_id)
            ->where('external_user_id', $user->id)
            ->firstOrFail();

        $message->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read.',
        ]);
    }

    /**
     * Close conversation.
     */
    public function closeConversation(Request $request, $conversationId)
    {
        $user = $request->user();

        $conversation = ChatConversation::where('id', $conversationId)
            ->where('external_user_id', $user->id)
            ->firstOrFail();

        $conversation->close();

        return response()->json([
            'success' => true,
            'message' => 'Conversation closed.',
        ]);
    }

    /**
     * Rate conversation.
     */
    public function rateConversation(Request $request, $conversationId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $conversation = ChatConversation::where('id', $conversationId)
            ->where('external_user_id', $user->id)
            ->where('status', 'closed')
            ->firstOrFail();

        $conversation->rate($request->rating, $request->feedback);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback!',
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

        $user = $request->user();

        $conversation = ChatConversation::where('id', $request->conversation_id)
            ->where('external_user_id', $user->id)
            ->firstOrFail();

        broadcast(new UserTyping($conversation, 'user', $user->id, $user->name))->toOthers();

        return response()->json(['success' => true]);
    }
}
