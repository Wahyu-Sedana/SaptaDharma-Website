<?php

namespace App\Filament\Resources\HistoryTimelineResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\HistoryTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryTimeline extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = HistoryTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
