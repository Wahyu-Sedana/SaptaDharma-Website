<?php

namespace App\Filament\Resources\SectionItemResource\Pages;

use App\Filament\Resources\SectionItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSectionItems extends ListRecords
{
    protected static string $resource = SectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
