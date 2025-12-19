<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('konten')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('foto')
                    ->image()
                    ->directory('berita')
                    ->disk('public')
                    ->maxSize(2048)
                    ->imagePreviewHeight('150'),
            ]);
    }
}
