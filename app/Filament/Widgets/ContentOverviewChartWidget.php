<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Book;
use App\Models\Founder;
use App\Models\Gallery;
use App\Models\HistoryTimeline;
use App\Models\Location;
use Filament\Widgets\ChartWidget;

class ContentOverviewChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Ringkasan Konten';

    protected static ?string $maxHeight = '280px';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'default' => 'full',
        'lg' => 2,
    ];

    protected function getData(): array
    {
        $labels = ['Artikel', 'Buku', 'Lokasi', 'Tokoh', 'Sejarah', 'Galeri'];

        $counts = [
            Article::count(),
            Book::count(),
            Location::count(),
            Founder::count(),
            HistoryTimeline::count(),
            Gallery::count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Konten',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#f59e0b',
                        '#22c55e',
                        '#0ea5e9',
                        '#a855f7',
                        '#ef4444',
                        '#eab308',
                    ],
                    'borderRadius' => 8,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
