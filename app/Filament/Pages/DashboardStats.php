<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\UserChart;
use BackedEnum;


class DashboardStats extends Page
{
    protected static ?string $navigationLabel = 'Statistik';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected string $view = 'filament.pages.dashboard-stats';

    protected function getHeaderWidgets(): array
    {
        return [
            UserChart::class,
        ];
    }
}
