<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Messages</h3>
    
    <div class="space-y-4 max-h-96 overflow-y-auto">
        @forelse($record->messages()->orderBy('created_at', 'asc')->get() as $message)
            <div class="flex {{ $message->sender_type === 'admin' ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[70%]">
                    <!-- Sender Info -->
                    <div class="text-xs text-gray-500 mb-1 {{ $message->sender_type === 'admin' ? 'text-right' : 'text-left' }}">
                        @if($message->sender_type === 'user')
                            <span class="font-medium">{{ $record->externalUser->name }}</span>
                        @elseif($message->sender_type === 'admin')
                            <span class="font-medium">{{ $message->sender()?->name ?? 'Admin' }}</span>
                        @else
                            <span class="font-medium italic">System</span>
                        @endif
                        <span class="ml-2">{{ $message->created_at->format('H:i') }}</span>
                    </div>
                    
                    <!-- Message Bubble -->
                    <div class="rounded-lg p-3 {{ $message->sender_type === 'admin' ? 'bg-indigo-600 text-white' : ($message->sender_type === 'system' ? 'bg-gray-100 text-gray-600 italic text-center' : 'bg-gray-200 text-gray-800') }}">
                        @if($message->message_type === 'text' || $message->message_type === 'system')
                            <p class="text-sm">{{ $message->content }}</p>
                        @elseif($message->message_type === 'image')
                            <img src="{{ $message->file_url }}" alt="{{ $message->file_name }}" class="rounded max-w-full">
                            <p class="text-xs mt-1">{{ $message->file_name }}</p>
                        @elseif($message->message_type === 'file')
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">{{ $message->file_name }}</p>
                                    <p class="text-xs opacity-75">{{ $message->formatted_file_size }}</p>
                                </div>
                            </div>
                            <a href="{{ $message->file_url }}" target="_blank" class="text-xs underline mt-1 block">Download</a>
                        @endif
                    </div>
                    
                    <!-- Read Status -->
                    @if($message->sender_type === 'admin' && $message->is_read)
                        <div class="text-xs text-gray-400 mt-1 text-right">
                            ✓✓ Read
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                No messages yet
            </div>
        @endforelse
    </div>
    
    <!-- User Info -->
    <div class="mt-6 pt-6 border-t border-gray-200">
        <h4 class="font-semibold mb-3">User Information</h4>
        <dl class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <dt class="text-gray-500">Name</dt>
                <dd class="font-medium">{{ $record->externalUser->name }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">Email</dt>
                <dd class="font-medium">{{ $record->externalUser->email }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">Organization</dt>
                <dd class="font-medium">{{ $record->externalUser->organization }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">Phone</dt>
                <dd class="font-medium">{{ $record->externalUser->phone ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>
