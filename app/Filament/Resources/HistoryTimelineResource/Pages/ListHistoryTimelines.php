<?php

namespace App\Filament\Resources\HistoryTimelineResource\Pages;

use App\Filament\Resources\HistoryTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoryTimelines extends ListRecords
{
    protected static string $resource = HistoryTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
