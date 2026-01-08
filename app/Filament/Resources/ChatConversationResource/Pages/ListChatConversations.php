<?php

namespace App\Filament\Resources\ChatConversationResource\Pages;

use App\Filament\Resources\ChatConversationResource;
use Filament\Resources\Pages\Page;

class ListChatConversations extends Page
{
    protected static string $resource = ChatConversationResource::class;

    protected string $view = 'filament.resources.chat-conversation-resource.pages.list-chat-conversations';
}
