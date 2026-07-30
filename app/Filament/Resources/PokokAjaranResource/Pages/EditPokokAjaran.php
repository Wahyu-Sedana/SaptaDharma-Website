<?php

namespace App\Filament\Resources\PokokAjaranResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\PokokAjaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPokokAjaran extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = PokokAjaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
