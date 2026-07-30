<?php

namespace App\Filament\Resources\FounderResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\FounderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFounder extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = FounderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
