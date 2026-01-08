<?php

namespace App\Events;

use App\Models\ChatConversation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTyping implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ChatConversation $conversation;
    public string $senderType;
    public int $senderId;
    public string $senderName;

    /**
     * Create a new event instance.
     */
    public function __construct(ChatConversation $conversation, string $senderType, int $senderId, string $senderName)
    {
        $this->conversation = $conversation;
        $this->senderType = $senderType;
        $this->senderId = $senderId;
        $this->senderName = $senderName;
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
        return 'user.typing';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'sender_type' => $this->senderType,
            'sender_id' => $this->senderId,
            'sender_name' => $this->senderName,
        ];
    }
}
