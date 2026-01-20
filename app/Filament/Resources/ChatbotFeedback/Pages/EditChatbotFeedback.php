<?php

namespace App\Filament\Resources\ChatbotFeedback\Pages;

use App\Filament\Resources\ChatbotFeedback\ChatbotFeedbackResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditChatbotFeedback extends EditRecord
{
    protected static string $resource = ChatbotFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
