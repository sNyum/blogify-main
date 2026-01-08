<?php

namespace App\Livewire\Admin;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class ChatConversationView extends Component
{
    public ChatConversation $conversation;
    public $messages = [];
    public $newMessage = '';

    public function mount(ChatConversation $conversation)
    {
        $this->conversation = $conversation;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = $this->conversation->messages()
            ->with('sender')
            ->oldest()
            ->get();
            
        // Mark unread admin/system messages as read? 
        // Actually admins read user messages.
        // If message is from user and is unread, mark as read.
        $this->conversation->messages()
            ->where('is_read', false)
            ->where('sender_type', 'user')
            ->update(['is_read' => true]);
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        if ($this->conversation->status === 'closed') {
            return;
        }

        $message = $this->conversation->messages()->create([
            'sender_type' => 'admin',
            'sender_id' => Auth::id(),
            'content' => $this->newMessage,
            'message_type' => 'text',
            'is_read' => false,
        ]);

        $this->newMessage = '';
        $this->loadMessages();

        // Broadcast event if needed
        broadcast(new MessageSent($message))->toOthers();
    }

    public function assignToMe()
    {
        $this->conversation->update([
            'assigned_admin_id' => Auth::id(),
            'status' => 'assigned',
        ]);
        
        // System message
        $this->conversation->messages()->create([
            'sender_type' => 'system',
            'content' => 'Chat assigned to ' . Auth::user()->name,
            'message_type' => 'text',
        ]);
        
        $this->loadMessages();
    }

    public function closeConversation()
    {
        $this->conversation->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        $this->conversation->messages()->create([
            'sender_type' => 'system',
            'content' => 'Conversation closed by ' . Auth::user()->name,
            'message_type' => 'text',
        ]);

        $this->loadMessages();
    }
    
    #[On('echo:chat.{conversation.id},MessageSent')] 
    public function refreshMessages()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.admin.chat-conversation-view');
    }
}
