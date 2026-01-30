<?php

namespace App\Filament\Resources\ExternalUserResource\Pages;

use App\Filament\Resources\ExternalUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternalUsers extends ListRecords
{
    protected static string $resource = ExternalUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
