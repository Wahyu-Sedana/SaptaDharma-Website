<?php

namespace App\Filament\Resources\HistoryHighlightResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\HistoryHighlightResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHistoryHighlight extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = HistoryHighlightResource::class;
}
