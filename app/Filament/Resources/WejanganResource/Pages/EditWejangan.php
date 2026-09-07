<?php

namespace App\Filament\Resources\WejanganResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\WejanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWejangan extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = WejanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
