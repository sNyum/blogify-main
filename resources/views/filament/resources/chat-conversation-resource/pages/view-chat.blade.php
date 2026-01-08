<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-4">
        @livewire('admin.chat-conversation-view', ['conversation' => $record])
    </div>
</x-filament-panels::page>
