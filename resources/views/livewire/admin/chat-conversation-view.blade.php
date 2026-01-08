<div class="bg-white dark:bg-gray-800 rounded-lg shadow" wire:poll.3s="loadMessages">
    @if($conversation)
        <!-- Conversation Header -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $conversation->subject }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $conversation->externalUser->name ?? 'Unknown User' }} 
                        ({{ $conversation->externalUser->email ?? 'No email' }})
                    </p>
                </div>
                <div class="flex gap-2">
                    @if($conversation->status === 'open')
                        <button 
                            wire:click="assignToMe"
                            class="px-3 py-1.5 text-sm bg-primary-600 text-white rounded-md hover:bg-primary-700"
                        >
                            Ambil Tiket
                        </button>
                    @endif
                    
                    @if($conversation->status !== 'closed')
                        <button 
                            wire:click="closeConversation"
                            class="px-3 py-1.5 text-sm bg-gray-600 text-white rounded-md hover:bg-gray-700"
                        >
                            Tutup Percakapan
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Messages Area -->
        <div class="p-4 h-[400px] overflow-y-auto space-y-3">
            @forelse($messages as $message)
                <div class="flex {{ $message->sender_type === 'admin' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[70%]">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                            @if($message->sender_type === 'admin')
                                {{ $message->sender->name ?? 'Admin' }}
                            @elseif($message->sender_type === 'system')
                                System
                            @else
                                {{ $conversation->externalUser->name ?? 'User' }}
                            @endif
                            <span class="ml-1">{{ $message->created_at->format('H:i') }}</span>
                        </div>
                        <div class="rounded-lg p-3 {{ $message->sender_type === 'admin' ? 'bg-primary-600 text-white' : ($message->sender_type === 'system' ? 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 italic' : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white') }}">
                            @if($message->message_type === 'file')
                                <a href="{{ Storage::url($message->content) }}" target="_blank" class="underline">
                                    📎 {{ basename($message->content) }}
                                </a>
                            @else
                                {{ $message->content }}
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <p>No messages yet</p>
                </div>
            @endforelse
        </div>

        <!-- Message Input -->
        @if($conversation->status !== 'closed')
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <form wire:submit.prevent="sendMessage" class="flex gap-2">
                    <input 
                        type="text" 
                        wire:model="newMessage"
                        placeholder="Type your message..."
                        class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                    />
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700"
                    >
                        Send
                    </button>
                </form>
            </div>
        @else
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 text-center text-gray-500 dark:text-gray-400">
                This conversation is closed
            </div>
        @endif
    @else
        <!-- No Conversation Selected -->
        <div class="flex items-center justify-center h-[600px] text-gray-500 dark:text-gray-400">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="mt-2">Select a conversation to start chatting</p>
            </div>
        </div>
    @endif
</div>
