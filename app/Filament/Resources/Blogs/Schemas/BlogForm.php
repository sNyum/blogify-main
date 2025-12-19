<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Hidden::make('user_id')
                ->default(fn () => Auth::id()),
            // 👇 Show current user name (readonly)
            Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->required(),

            Select::make('subcategory_id')
                ->label('Subcategory')
                ->relationship('subcategory', 'name')
                ->searchable()
                ->required(),

            Select::make('tag_id')
                ->label('Tag')
                ->relationship('tag', 'name')
                ->searchable()
                ->required(),
            TextInput::make('title')
                ->required()
                ->maxLength(255),

            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique('blogs', 'slug', ignoreRecord: true),

            FileUpload::make('thumbnail_image')
                ->label('Thumbnail Image')
                ->image()
                ->directory('blogs/thumbnails')
                ->maxSize(2048)
                ->imagePreviewHeight('150px'),

            RichEditor::make('description')
                ->label('Short Description')
                ->columnSpanFull(),

            RichEditor::make('content')
                ->label('Main Content')
                ->fileAttachmentsDirectory('blogs/content-images')
                ->columnSpanFull(),

            TextInput::make('meta_title')->label('Meta Title'),
            Textarea::make('meta_description')->label('Meta Description')->rows(2),
            TextInput::make('meta_keywords')->label('Meta Keywords'),

            Toggle::make('is_published')
                ->label('Published')
                ->default(false),
        ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['user_id'])) {
            $data['user_id'] = Auth::id();
        }
        return $data;
    }
}
