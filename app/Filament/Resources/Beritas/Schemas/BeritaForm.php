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
                    ->nullable()
                    ->image()
                    ->disk('public')
                    ->directory('berita-images'),

                Forms\Components\TextInput::make('youtube_url')
                    ->label('Link Sumber / YouTube (Opsional)')
                    ->url()
                    ->placeholder('https://...')
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\TextInput::make('channel_name')
                    ->label('Nama Sumber / Channel')
                    ->placeholder('Contoh: Detik.com, BPS Batanghari')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }
}
