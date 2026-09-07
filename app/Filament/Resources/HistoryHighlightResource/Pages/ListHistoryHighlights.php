<?php

namespace App\Filament\Resources\HistoryHighlightResource\Pages;

use App\Filament\Resources\HistoryHighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoryHighlights extends ListRecords
{
    protected static string $resource = HistoryHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
