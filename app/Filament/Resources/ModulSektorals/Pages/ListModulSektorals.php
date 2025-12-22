<?php

namespace App\Filament\Resources\ModulSektorals\Pages;

use App\Filament\Resources\ModulSektorals\ModulSektoralResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModulSektorals extends ListRecords
{
    protected static string $resource = ModulSektoralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
