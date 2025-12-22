<?php

namespace App\Filament\Resources\ModulSektorals;

use App\Filament\Resources\ModulSektorals\Pages\CreateModulSektoral;
use App\Filament\Resources\ModulSektorals\Pages\EditModulSektoral;
use App\Filament\Resources\ModulSektorals\Pages\ListModulSektorals;
use App\Filament\Resources\ModulSektorals\Schemas\ModulSektoralForm;
use App\Filament\Resources\ModulSektorals\Tables\ModulSektoralsTable;
use App\Models\ModulSektoral;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ModulSektoralResource extends Resource
{
    protected static ?string $model = ModulSektoral::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ModulSektoralForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModulSektoralsTable::configure($table);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['judul']);
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['judul']);
        return $data;
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
            'index' => ListModulSektorals::route('/'),
            'create' => CreateModulSektoral::route('/create'),
            'edit' => EditModulSektoral::route('/{record}/edit'),
        ];
    }
}
