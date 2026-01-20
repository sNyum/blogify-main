<?php

namespace App\Filament\Resources\ChatbotFeedback;

use App\Filament\Resources\ChatbotFeedback\Pages\CreateChatbotFeedback;
use App\Filament\Resources\ChatbotFeedback\Pages\EditChatbotFeedback;
use App\Filament\Resources\ChatbotFeedback\Pages\ListChatbotFeedback;
use App\Filament\Resources\ChatbotFeedback\Schemas\ChatbotFeedbackForm;
use App\Filament\Resources\ChatbotFeedback\Tables\ChatbotFeedbackTable;
use App\Models\ChatbotFeedback;
// use BackedEnum; (Removed)
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ChatbotFeedbackResource extends Resource
{
    protected static ?string $model = ChatbotFeedback::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    
    protected static string|\UnitEnum|null $navigationGroup = 'Layanan Publik';

    protected static ?int $navigationSort = 2; // Below Live Chat

    protected static ?string $recordTitleAttribute = 'user_query';

    public static function form(Schema $schema): Schema
    {
        return ChatbotFeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChatbotFeedbackTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChatbotFeedback::route('/'),
            'create' => CreateChatbotFeedback::route('/create'),
            'edit' => EditChatbotFeedback::route('/{record}/edit'),
        ];
    }
}
