<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Book;
use App\Models\Founder;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\HistoryTimeline;
use App\Models\Location;
use App\Models\LuhurValue;
use App\Models\PokokAjaran;
use Filament\Widgets\ChartWidget;

class PublishStatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Status Publikasi';

    protected static ?string $maxHeight = '280px';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'default' => 'full',
        'lg' => 1,
    ];

    protected function getData(): array
    {
        $models = [Hero::class, Article::class, Book::class, Location::class, Founder::class, HistoryTimeline::class, Gallery::class, LuhurValue::class, PokokAjaran::class];

        $published = collect($models)->sum(fn (string $model) => $model::where('status', 'publish')->count());
        $draft = collect($models)->sum(fn (string $model) => $model::where('status', 'draft')->count());

        return [
            'datasets' => [
                [
                    'data' => [$published, $draft],
                    'backgroundColor' => ['#22c55e', '#cbd5e1'],
                ],
            ],
            'labels' => ['Publish', 'Draft'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}
