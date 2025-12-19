<?php

namespace App\Filament\Resources\Beritas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BeritasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->disk('public')
                    ->height(60),

                TextColumn::make('judul')
                    ->searchable(),

                TextColumn::make('konten')
                    ->limit(50),
            ])
            ->defaultSort('created_at', 'desc')
            ->rowActions([
    EditAction::make(),
]);

    }
}
