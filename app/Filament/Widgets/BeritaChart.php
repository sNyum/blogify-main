<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use Filament\Widgets\ChartWidget;

class BeritaChart extends ChartWidget
{
    public function getHeading(): string
    {
        return 'Jumlah Berita';
    }

    public function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Berita',
                    'data' => Berita::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                        ->groupBy('date')
                        ->orderBy('date')
                        ->pluck('total')
                        ->toArray(),
                ],
            ],
            'labels' => Berita::selectRaw('DATE(created_at) as date')
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('date')
                ->toArray(),
        ];
    }
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
