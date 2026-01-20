<?php

namespace App\Filament\Resources\ChatbotFeedback\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ChatbotFeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('user_query')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('bot_response')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('rating')
                    ->options(['up' => 'Up', 'down' => 'Down'])
                    ->required(),
                Textarea::make('feedback_text')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
