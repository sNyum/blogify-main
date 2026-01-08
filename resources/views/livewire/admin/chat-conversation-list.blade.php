<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4" wire:poll.3s="loadConversations">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Conversations</h3>
        
        <!-- Status Filter -->
        <select wire:model.live="statusFilter" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            <option value="all">All Status</option>
            <option value="open">Open</option>
            <option value="assigned">Assigned</option>
            <option value="closed">Closed</option>
        </select>
    </div>

    <!-- Conversations List -->
    <div class="space-y-2 max-h-[600px] overflow-y-auto">
        @forelse($conversations as $conversation)
            <div 
                wire:click="selectConversation({{ $conversation->id }})"
                class="p-3 rounded-lg cursor-pointer transition-colors {{ $selectedConversationId == $conversation->id ? 'bg-primary-100 dark:bg-primary-900' : 'bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
            >
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                            {{ $conversation->externalUser->name ?? 'Unknown User' }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                            {{ $conversation->subject }}
                        </p>
                    </div>
                    <div class="ml-2 flex-shrink-0">
                        @if($conversation->status === 'open')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Open
                            </span>
                        @elseif($conversation->status === 'assigned')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Assigned
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                Closed
                            </span>
                        @endif
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                    {{ $conversation->updated_at->diffForHumans() }}
                </p>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                <p>No conversations found</p>
            </div>
        @endforelse
    </div>
</div>
