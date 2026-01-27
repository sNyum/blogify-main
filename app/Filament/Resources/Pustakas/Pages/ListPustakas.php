<?php

namespace App\Filament\Resources\Pustakas\Pages;

use App\Filament\Resources\Pustakas\PustakaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPustakas extends ListRecords
{
    protected static string $resource = PustakaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

}
