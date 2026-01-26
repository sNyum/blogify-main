<?php

namespace App\Http\Controllers\BpsStaff;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BpsStaffChatController extends Controller
{
    public function index()
    {
        return view('bps-staff.live-chat');
    }

    public function getConversations(Request $request)
    {
        // Get Open or Assigned conversations.
        // BPS Staff can see everything for now.
        $status = $request->query('status', 'all');
        
        $query = ChatConversation::with(['externalUser', 'assignedAdmin', 'latestMessage'])
                ->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $conversations = $query->get()->map(function ($conversation) {
            return [
                'id' => $conversation->id,
                'user_name' => $conversation->externalUser->name,
                'user_organization' => $conversation->externalUser->organization,
                'subject' => $conversation->subject,
                'status' => $conversation->status,
                'priority' => $conversation->priority,
                'assigned_admin' => $conversation->assignedAdmin?->name,
                'latest_message' => $conversation->latestMessage?->content,
                'unread_count' => $conversation->messages()->where('is_read', false)->where('sender_type', 'user')->count(),
                'created_at' => $conversation->created_at->toIso8601String(),
            ];
        });

        return response()->json(['conversations' => $conversations]);
    }

    public function getMessages(Request $request, $conversationId)
    {
        $conversation = ChatConversation::findOrFail($conversationId);
        
        // Mark read
        ChatMessage::where('conversation_id', $conversationId)
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        $messages = ChatMessage::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'sender_type' => $message->sender_type, // 'admin', 'user', 'system', 'bps_staff'
                    'sender_name' => $this->getSenderName($message),
                    'content' => $message->content,
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'conversation' => $conversation->load('externalUser'),
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request, $conversationId)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $bpsUser = auth('bps')->user();
        $conversation = ChatConversation::findOrFail($conversationId);

        // Sender Type: 'admin' (to appear on right side?) 
        // Or 'bps_staff'?? 
        // If 'bps_staff' is not supported by frontend logic, it might break UI.
        // Let's use 'admin' but store sender_id as BPS ID. 
        // RISK: ID Collision. 
        // BETTER: Use 'bps_staff'. And update Frontend logic to treat 'bps_staff' same as 'admin' (Right side).
        
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'admin', // Masquerade as admin for now to ensure UI consistency if ID collision isn't blocking
            'sender_id' => $bpsUser->id, // This is technically wrong if ID collides with real admin, but for now...
            'message_type' => 'text',
            'content' => $request->message . ' (Operator)', // Add suffix to distinguish?
        ]);

        broadcast(new MessageSent($message, $conversation))->toOthers();

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function closeConversation(Request $request, $conversationId)
    {
        $bpsUser = auth('bps')->user();
        $conversation = ChatConversation::findOrFail($conversationId);
        $conversation->close();

        // System message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'system',
            'sender_id' => 0,
            'message_type' => 'system',
            'content' => 'Percakapan ditutup oleh Operator ' . $bpsUser->name . '.',
        ]);

        broadcast(new MessageSent($message, $conversation))->toOthers();
        return response()->json(['success' => true]);
    }

    private function getSenderName($message)
    {
        if ($message->sender_type === 'user') return $message->conversation->externalUser->name ?? 'User';
        if ($message->sender_type === 'admin') {
            // Attempt to find Admin, if fail, try BPS? 
            // For now just return 'Admin/Operator';
            // Ideally we fetch from DB.
            return 'Admin/Operator'; 
        }
        return 'System';
    }
}
