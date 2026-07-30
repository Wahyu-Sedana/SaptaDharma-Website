<?php

namespace App\Filament\Resources\HistoryTimelineResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\HistoryTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHistoryTimeline extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = HistoryTimelineResource::class;
}
