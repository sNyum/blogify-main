<?php

namespace App\Filament\Resources\ModulSektorals\Schemas;

use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Get;
use Filament\Forms\Set;

class ModulSektoralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
    ->label('Judul Modul')
    ->required()
    ->live(onBlur: true)
    ->afterStateUpdated(function ($state, callable $set) {
        $set('slug', Str::slug($state));
    }),
                TextInput::make('slug')
    ->label('Slug')
    ->required()
    ->disabled()      // tidak bisa diedit manual
    ->dehydrated(),   // TETAP disimpan ke database
                Textarea::make('deskripsi')
                    ->nullable(),

                FileUpload::make('attachment_file')
                    ->label('File Presentasi (PPT/PDF)')
                    ->acceptedFileTypes(['application/pdf', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])
                    ->disk('public')
                    ->directory('modul-sektoral-files')
                    ->columnSpanFull(),
            ]);
    }
}
