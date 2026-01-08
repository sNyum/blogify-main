<x-filament-panels::page>
    <div wire:poll.3s class="flex flex-col h-[600px] border border-gray-200 rounded-lg bg-white shadow-sm">
        
        <!-- Header Actions -->
        <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800">{{ $record->subject }}</h3>
                <p class="text-sm text-gray-500">
                    User: {{ $record->externalUser->name }} | Status: {{ $record->status }}
                </p>
            </div>
            <div class="flex space-x-2">
                @if($record->status === 'open')
                    <x-filament::button wire:click="assignToMe" color="warning">
                        Ambil Tiket
                    </x-filament::button>
                @endif
                
                @if($record->status !== 'closed')
                    <x-filament::button wire:click="closeConversation" color="danger" icon="heroicon-o-x-circle">
                        Tutup Percakapan
                    </x-filament::button>
                @else
                    <span class="text-red-600 font-bold px-4 py-2 bg-red-50 rounded">TERTUTUP</span>
                @endif
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 flex flex-col-reverse">
            <!-- Note: Flex-col-reverse makes it sticky to bottom usually, but order needs to be reversed too. 
                 Let's stick to standard order + scrolling via JS or just simple list.
                 Actually, simple list with natural order is easier to reason about. -->
             <div class="flex flex-col space-y-4">
                @foreach($this->messages as $message)
                    <div class="flex flex-col {{ $message->sender_type === 'admin' ? 'items-end' : 'items-start' }}">
                        <div class="max-w-[70%] rounded-lg p-3 text-sm shadow-sm
                                    {{ $message->sender_type === 'admin' ? 'bg-primary-600 text-white rounded-br-none' : 'bg-gray-100 text-gray-800 rounded-bl-none' }}
                                    {{ $message->message_type === 'system' ? 'bg-yellow-50 text-yellow-800 border border-yellow-200 text-center w-full max-w-full my-2' : '' }}">
                            
                            @if($message->message_type === 'system')
                                <p class="text-center italic">{{ $message->content }}</p>
                            @else
                                <div>
                                    <p class="whitespace-pre-wrap">{{ $message->content }}</p>
                                    
                                    @if($message->file_path)
                                        <div class="mt-2 p-2 bg-white/20 rounded overflow-hidden">
                                            @if($message->message_type === 'image')
                                                <a href="{{ $message->file_url }}" target="_blank">
                                                    <img src="{{ $message->file_url }}" class="max-w-full h-auto rounded max-h-48 object-cover">
                                                </a>
                                            @else
                                                <a href="{{ $message->file_url }}" target="_blank" class="flex items-center space-x-2 text-inherit underline">
                                                    <x-heroicon-o-paper-clip class="w-4 h-4" />
                                                    <span>{{ $message->file_name }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-1 flex justify-end items-center opacity-70 text-[10px] {{ $message->sender_type === 'admin' ? 'text-primary-100' : 'text-gray-400' }}">
                                <span>{{ $message->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">
                            {{ $message->sender_type === 'admin' ? 'Anda' : ($message->sender_type === 'system' ? 'System' : $record->externalUser->name) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Input Area -->
        @if($record->status !== 'closed')
            <div class="p-4 bg-white border-t border-gray-200">
                <form wire:submit="sendMessage" class="flex flex-col space-y-2">
                    <div class="w-1/3">
                         <x-filament::input.wrapper>
                            <x-filament::input.select wire:model.live="selectedCannedResponseId">
                                <option value="">Pilih Template Balasan...</option>
                                @foreach($this->cannedResponses as $id => $title)
                                    <option value="{{ $id }}">{{ $title }}</option>
                                @endforeach
                            </x-filament::input.select>
                        </x-filament::input.wrapper>
                    </div>
                    <textarea wire:model="newMessage" 
                              class="w-full border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500" 
                              rows="2" 
                              placeholder="Ketik balasan... (Enter untuk kirim)"
                              wire:keydown.enter.prevent="sendMessage"></textarea>
                    
                    <div class="flex justify-end">
                        <x-filament::button type="submit">
                            Kirim Balasan
                        </x-filament::button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</x-filament-panels::page>
