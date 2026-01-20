<?php

namespace App\Filament\Resources\ChatbotFeedback\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChatbotFeedbackTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_query')
                    ->label('Pertanyaan User')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('bot_response')
                    ->label('Jawaban Bot')
                    ->limit(50),
                TextColumn::make('rating')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'up' => 'success',
                        'down' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'up' => '👍 Positif',
                        'down' => '👎 Negatif',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
