<?php

namespace App\Filament\Resources\HistoryHighlightResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\HistoryHighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryHighlight extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = HistoryHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
