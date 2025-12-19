<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    public function getHeading(): string
    {
        return 'User Registration';
    }

    public function getType(): string
    {
        return 'line'; // bar | line | pie | doughnut | radar | polarArea | bubble | scatter
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => User::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                        ->groupBy('date')
                        ->pluck('total')
                        ->toArray(),
                ],
            ],
            'labels' => User::selectRaw('DATE(created_at) as date')
                ->groupBy('date')
                ->pluck('date')
                ->toArray(),
        ];
    }
}
