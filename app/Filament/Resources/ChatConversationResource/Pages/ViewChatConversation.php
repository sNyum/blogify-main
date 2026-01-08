<?php

namespace App\Filament\Resources\ChatConversationResource\Pages;

use App\Filament\Resources\ChatConversationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChatConversation extends ViewRecord
{
    protected static string $resource = ChatConversationResource::class;

    protected string $view = 'filament.resources.chat-conversation-resource.pages.view-chat';
}
