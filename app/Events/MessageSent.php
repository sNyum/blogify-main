<?php

namespace App\Events;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ChatMessage $message;
    public ChatConversation $conversation;

    /**
     * Create a new event instance.
     */
    public function __construct(ChatMessage $message, ChatConversation $conversation)
    {
        $this->message = $message;
        $this->conversation = $conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->conversation->id),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'conversation_id' => $this->message->conversation_id,
                'sender_type' => $this->message->sender_type,
                'sender_id' => $this->message->sender_id,
                'message_type' => $this->message->message_type,
                'content' => $this->message->content,
                'file_path' => $this->message->file_path,
                'file_name' => $this->message->file_name,
                'file_size' => $this->message->file_size,
                'formatted_file_size' => $this->message->formatted_file_size,
                'file_url' => $this->message->file_url,
                'is_read' => $this->message->is_read,
                'created_at' => $this->message->created_at->toIso8601String(),
            ],
            'conversation' => [
                'id' => $this->conversation->id,
                'status' => $this->conversation->status,
            ],
        ];
    }
}
