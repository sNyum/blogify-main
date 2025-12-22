<?php

namespace App\Filament\Resources\ModulSektorals\Pages;

use App\Filament\Resources\ModulSektorals\ModulSektoralResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModulSektoral extends EditRecord
{
    protected static string $resource = ModulSektoralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
