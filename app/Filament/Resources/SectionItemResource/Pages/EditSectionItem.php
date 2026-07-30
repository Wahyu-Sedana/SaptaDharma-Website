<?php

namespace App\Filament\Resources\SectionItemResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\SectionItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionItem extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = SectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
