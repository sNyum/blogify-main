<?php

namespace App\Filament\Resources\Pustakas;

use App\Filament\Resources\Pustakas\Pages\CreatePustaka;
use App\Filament\Resources\Pustakas\Pages\EditPustaka;
use App\Filament\Resources\Pustakas\Pages\ListPustakas;
use App\Models\Pustaka;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PustakaResource extends Resource
{
    protected static ?string $model = Pustaka::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Pustaka';
    protected static ?string $pluralModelLabel = 'Pustaka';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(Pustaka::class, 'slug', ignoreRecord: true),

                FileUpload::make('cover_path')
                    ->label('Cover Image')
                    ->image()
                    ->disk('public')
                    ->directory('pustaka-covers'),

                FileUpload::make('pdf_path')
                    ->label('PDF File')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('pustaka-pdfs')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_path')->label('Cover'),
                TextColumn::make('judul')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                Action::make('view_pdf')
                    ->label('View PDF')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Pustaka $record) => asset('storage/' . $record->pdf_path))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListPustakas::route('/'),
            'create' => CreatePustaka::route('/create'),
            'edit' => EditPustaka::route('/{record}/edit'),
        ];
    }
}
