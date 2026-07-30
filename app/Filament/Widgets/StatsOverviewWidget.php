<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Book;
use App\Models\Founder;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\HistoryTimeline;
use App\Models\Location;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $articles = Article::count();
        $articlesPublished = Article::where('status', 'publish')->count();
        $articleViews = (int) Article::sum('views');

        $books = Book::count();
        $booksPublished = Book::where('status', 'publish')->count();
        $bookDownloads = (int) Book::sum('downloads');

        $heroes = Hero::count();
        $locations = Location::where('status', 'publish')->count();
        $founders = Founder::count();
        $timeline = HistoryTimeline::count();
        $galleries = Gallery::count();

        return [
            Stat::make('Artikel', $articles)
                ->description("{$articlesPublished} publish · " . number_format($articleViews) . ' dilihat')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),

            Stat::make('Buku', $books)
                ->description("{$booksPublished} publish · " . number_format($bookDownloads) . ' diunduh')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),

            Stat::make('Lokasi Aktif', $locations)
                ->description("{$founders} tokoh · {$timeline} titik sejarah")
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info'),

            Stat::make('Media', $heroes + $galleries)
                ->description("{$heroes} hero · {$galleries} galeri")
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),
        ];
    }
}
