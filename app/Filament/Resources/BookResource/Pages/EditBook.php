<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBook extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
