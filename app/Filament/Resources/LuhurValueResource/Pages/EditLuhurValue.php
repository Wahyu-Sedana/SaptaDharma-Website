<?php

namespace App\Filament\Resources\LuhurValueResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\LuhurValueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLuhurValue extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = LuhurValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
