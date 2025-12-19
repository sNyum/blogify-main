<?php

namespace App\Filament\Resources\Blogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('subcategory.name')
                    ->label('Subcategory')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tag.name')
                    ->label('Tag')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('thumbnail_image'),
                TextColumn::make('meta_title')
                    ->searchable(),
                TextColumn::make('meta_keywords')
                    ->searchable(),
                IconColumn::make('is_published')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
               EditAction::make()
                ->label('Edit')
                ->button()
                ->color('warning')
                ->extraAttributes([
                    'style' => 'border-top-right-radius: 0; border-bottom-right-radius: 0; position:relative; left:12px;'
                ]),

                DeleteAction::make()
                    ->label('Delete')
                    ->button()
                    ->color('danger')
                    ->extraAttributes([
                    'style' => 'border-top-left-radius: 0; border-bottom-left-radius: 0;'
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
