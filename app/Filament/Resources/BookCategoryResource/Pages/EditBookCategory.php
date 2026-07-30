<?php

namespace App\Filament\Resources\BookCategoryResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\BookCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookCategory extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = BookCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
