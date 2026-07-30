<?php

namespace App\Filament\Resources\PokokAjaranItemResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\PokokAjaranItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPokokAjaranItem extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = PokokAjaranItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
