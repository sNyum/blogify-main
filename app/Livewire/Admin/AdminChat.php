<?php

namespace App\Livewire\Admin;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ExternalUser;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class AdminChat extends Component
{
    use WithFileUploads;

    // use Livewire\Attributes\Computed; // Removed from here

    // public $conversations; // Refactored to computed
    public $currentConversation;
    public $messages = [];
    public $newMessage = '';
    public $file;
    public $search = '';
    public $filter = 'all'; // all, open, assigned, closed

    public function mount()
    {
        // $this->loadConversations(); // Computed property handles this
    }

    #[Computed]
    public function conversations()
    {
        $query = ChatConversation::with(['externalUser', 'latestMessage'])
            ->latest('updated_at');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('subject', 'like', '%' . $this->search . '%')
                  ->orWhereHas('externalUser', function($sq) {
                      $sq->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        return $query->get();
    }

    public function selectConversation($conversationId)
    {
        $this->currentConversation = ChatConversation::with('externalUser')->find($conversationId);
        $this->loadMessages();
        $this->dispatch('scrollToBottom');
    }

    public function loadMessages()
    {
        if (!$this->currentConversation) return;

        $this->messages = $this->currentConversation->messages()
            ->with('sender')
            ->oldest()
            ->get();

        // Mark user messages as read
        $this->currentConversation->messages()
            ->where('is_read', false)
            ->where('sender_type', 'user')
            ->update(['is_read' => true]);
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'nullable|string|max:1000',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);

        if ((!$this->newMessage && !$this->file) || !$this->currentConversation) {
            return;
        }

        if ($this->currentConversation->status === 'closed') {
            return;
        }

        // Handle File Upload
        $filePath = null;
        $fileName = null;
        $fileSize = null;
        $messageType = 'text';

        if ($this->file) {
            $fileName = $this->file->getClientOriginalName();
            $fileSize = $this->file->getSize();
            $filePath = $this->file->store('chat-files', 'public');
            
            $mime = $this->file->getMimeType();
            $messageType = str_starts_with($mime, 'image/') ? 'image' : 'file';
        }

        $message = $this->currentConversation->messages()->create([
            'sender_type' => 'admin',
            'sender_id' => Auth::id(),
            'content' => $this->newMessage ?? ($this->file ? 'File attached' : ''),
            'message_type' => $messageType,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'is_read' => false,
        ]);

        $this->newMessage = '';
        $this->file = null;
        $this->loadMessages();
        $this->dispatch('scrollToBottom');

        broadcast(new MessageSent($message))->toOthers();
    }

    public function assignToMe()
    {
        if (!$this->currentConversation) return;

        $this->currentConversation->update([
            'assigned_admin_id' => Auth::id(),
            'status' => 'assigned',
        ]);
        
        $this->currentConversation->messages()->create([
            'sender_type' => 'system',
            'sender_id' => Auth::id() ?? 0,
            'content' => 'Chat assigned to ' . Auth::user()->name,
            'message_type' => 'system',
        ]);
        
        $this->loadMessages();
    }

    public function closeConversation()
    {
        if (!$this->currentConversation) return;

        $this->currentConversation->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        $this->currentConversation->messages()->create([
            'sender_type' => 'system',
            'sender_id' => Auth::id() ?? 0,
            'content' => 'Conversation closed by ' . Auth::user()->name,
            'message_type' => 'system',
        ]);

        $this->loadMessages();
    }

    #[On('echo:chat.conversations,NewConversation')] 
    public function refreshConversations()
    {
        // Computed property will verify automatically
    }
    
    // We need to listen to specific conversation channel dynamically
    // But Livewire Attributes limitation requests static channel names usually.
    // For specific convo updates, we rely on polling or we could use the Listeners array method.

    public function getListeners()
    {
        $listeners = [
            'echo:chat.conversations,NewConversation' => 'refreshConversations',
        ];

        if ($this->currentConversation) {
            $listeners["echo:chat.{$this->currentConversation->id},MessageSent"] = 'handleNewMessage';
        }

        return $listeners;
    }

    public function handleNewMessage($event)
    {
        if ($this->currentConversation && $this->currentConversation->id == $event['message']['conversation_id']) {
            $this->loadMessages();
            $this->dispatch('scrollToBottom');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-chat', [
            'conversations' => $this->conversations
        ]);
    }
}
