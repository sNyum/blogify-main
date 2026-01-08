<div class="flex h-[calc(100vh-150px)] min-h-[600px] bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    
    <!-- Sidebar -->
    <div class="w-80 border-r border-gray-200 dark:border-gray-700 flex flex-col bg-gray-50/50 dark:bg-gray-900/50">
        <!-- Header & Search -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-3">Live Chat</h2>
            
            <div class="relative mb-3">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari user atau subjek..." 
                       class="w-full pl-9 pr-3 py-2 text-sm bg-gray-100 dark:bg-gray-700 border-none rounded-lg focus:ring-1 focus:ring-primary">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <div class="flex gap-1 overflow-x-auto pb-1 no-scrollbar">
                <button wire:click="$set('filter', 'all')" 
                        class="px-3 py-1 text-xs font-medium rounded-full border transition-colors whitespace-nowrap
                        {{ $filter === 'all' ? 'bg-gray-800 text-white dark:bg-gray-200 dark:text-gray-900' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700' }}">
                    Semua
                </button>
                <button wire:click="$set('filter', 'open')" 
                        class="px-3 py-1 text-xs font-medium rounded-full border transition-colors whitespace-nowrap
                        {{ $filter === 'open' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700' }}">
                    Open
                </button>
                <button wire:click="$set('filter', 'assigned')" 
                        class="px-3 py-1 text-xs font-medium rounded-full border transition-colors whitespace-nowrap
                        {{ $filter === 'assigned' ? 'bg-yellow-600 text-white border-yellow-600' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700' }}">
                    Assigned
                </button>
            </div>
        </div>

        <!-- Conversation List -->
        <div class="flex-1 overflow-y-auto" wire:poll.10s>
            @forelse($conversations as $conversation)
                <div wire:click="selectConversation({{ $conversation->id }})" 
                     class="p-4 cursor-pointer border-b border-gray-100 dark:border-gray-800 hover:bg-white dark:hover:bg-gray-800 transition-colors {{ $currentConversation && $currentConversation->id === $conversation->id ? 'bg-white dark:bg-gray-800 border-l-4 border-l-primary shadow-sm' : '' }}">
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate max-w-[140px]">
                            {{ $conversation->externalUser->name ?? 'User' }}
                        </h3>
                        <span class="text-[10px] text-gray-400 whitespace-nowrap">
                            {{ $conversation->updated_at->format('H:i') }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate mb-2">
                        {{ $conversation->subject }}
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="px-2 py-0.5 rounded text-[10px] font-medium
                            {{ $conversation->status === 'open' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 
                               ($conversation->status === 'assigned' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400') }}">
                            {{ ucfirst($conversation->status) }}
                        </span>
                        @if($conversation->unreadMessagesCount() > 0)
                            <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                {{ $conversation->unreadMessagesCount() }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                    Tidak ada percakapan ditemukan.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Chat Area -->
    <div class="flex-1 flex flex-col bg-white dark:bg-gray-900 relative">
        @if($currentConversation)
            <!-- Chat Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-white dark:bg-gray-800 z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary flex items-center justify-center font-bold text-lg">
                        {{ substr($currentConversation->externalUser->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $currentConversation->externalUser->name }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $currentConversation->subject }} • {{ $currentConversation->externalUser->email }}</p>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    @if($currentConversation->status === 'open')
                        <button wire:click="assignToMe" 
                                class="px-3 py-1.5 text-xs font-medium bg-primary text-white rounded-lg hover:bg-primary-hover transition">
                            Ambil Tiket
                        </button>
                    @endif
                    
                    @if($currentConversation->status !== 'closed')
                        <button wire:click="closeConversation"
                                class="px-3 py-1.5 text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            Tutup Sesi
                        </button>
                    @else
                        <span class="px-3 py-1.5 text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400 rounded-lg">
                            Sesi Ditutup
                        </span>
                    @endif
                </div>
            </div>

            <!-- Messages List -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50 dark:bg-gray-900/50" id="admin-chat-container">
                @foreach($messages as $message)
                    <div class="flex flex-col {{ $message->isFromAdmin() ? 'items-end' : ($message->isSystem() ? 'items-center' : 'items-start') }}">
                        
                        @if($message->isSystem())
                            <div class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-3 py-1 rounded-full my-2">
                                {{ $message->content }}
                            </div>
                        @else
                            <div class="flex items-end gap-2 max-w-[80%]">
                                @if(!$message->isFromAdmin())
                                    <div class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-700 flex-shrink-0"></div>
                                @endif

                                <div class="px-4 py-2 text-sm shadow-sm rounded-2xl 
                                    {{ $message->isFromAdmin() 
                                        ? 'bg-primary text-white rounded-tr-sm' 
                                        : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-100 dark:border-gray-700 rounded-tl-sm' 
                                    }}">
                                    
                                    @if($message->message_type === 'image')
                                        <div class="mb-2">
                                            <a href="{{ $message->file_url }}" target="_blank">
                                                <img src="{{ $message->file_url }}" class="max-w-xs rounded-lg border border-white/20">
                                            </a>
                                        </div>
                                    @elseif($message->message_type === 'file')
                                        <div class="flex items-center gap-2 mb-1 p-2 bg-black/10 rounded">
                                            <svg class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            <a href="{{ $message->file_url }}" target="_blank" class="underline truncate max-w-[150px]">
                                                {{ $message->file_name }}
                                            </a>
                                        </div>
                                    @endif

                                    @if($message->content)
                                        <p class="whitespace-pre-wrap">{{ $message->content }}</p>
                                    @endif
                                    
                                    <div class="text-[10px] mt-1 text-right {{ $message->isFromAdmin() ? 'text-primary' : 'text-gray-400' }}">
                                        {{ $message->created_at->format('H:i') }}
                                        @if($message->isFromAdmin())
                                            <span class="ml-1 opacity-70">
                                                {{ $message->is_read ? '✓✓' : '✓' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Input Area -->
            @if($currentConversation->status !== 'closed')
                <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <form wire:submit.prevent="sendMessage" class="flex gap-3 items-end">
                        <div class="flex-1 relative">
                            @if($file)
                                <div class="absolute bottom-full mb-2 left-0 p-2 bg-white dark:bg-gray-700 shadow rounded-lg border dark:border-gray-600 flex items-center gap-2 text-xs">
                                    <span class="font-medium dark:text-gray-200">{{ $file->getClientOriginalName() }}</span>
                                    <button type="button" wire:click="$set('file', null)" class="text-red-500 hover:text-red-600">×</button>
                                </div>
                            @endif
                            <textarea wire:model="newMessage"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary overflow-hidden resize-none dark:text-white placeholder-gray-400"
                                    rows="1"
                                    placeholder="Tulis pesan..."
                                    x-data @keydown.enter.prevent="if(!$event.shiftKey) $wire.sendMessage()"></textarea>
                        </div>
                        
                        <div class="flex gap-2">
                             <label class="cursor-pointer p-3 text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition">
                                <input type="file" wire:model="file" class="hidden">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            </label>
                            
                            <button type="submit" 
                                    class="p-3 bg-primary text-white rounded-xl hover:bg-primary-hover transition shadow-lg shadow-primary/20">
                                <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                 <div class="p-6 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 text-center text-gray-500 dark:text-gray-400">
                    <p class="text-sm">Percakapan ini telah selesai.</p>
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="flex-1 flex flex-col items-center justify-center p-8 text-center bg-gray-50/30 dark:bg-gray-900">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">Live Chat Admin</h3>
                <p class="text-gray-500 text-sm max-w-sm">Pilih percakapan dari panel sebelah kiri untuk melihat riwayat pesan dan mulai membalas.</p>
            </div>
        @endif
    </div>

    <!-- Scroll Script -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            const container = document.getElementById('admin-chat-container');
            const scrollToBottom = () => {
                if(container) container.scrollTop = container.scrollHeight;
            };

            Livewire.on('scrollToBottom',scrollToBottom);
        });
    </script>
</div>
