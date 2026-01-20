<?php

namespace App\Filament\Resources\ChatbotFeedback\Pages;

use App\Filament\Resources\ChatbotFeedback\ChatbotFeedbackResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListChatbotFeedback extends ListRecords
{
    protected static string $resource = ChatbotFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
