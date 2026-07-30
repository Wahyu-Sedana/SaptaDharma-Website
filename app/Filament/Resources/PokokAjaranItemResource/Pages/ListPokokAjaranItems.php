<?php

namespace App\Filament\Resources\PokokAjaranItemResource\Pages;

use App\Filament\Resources\PokokAjaranItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPokokAjaranItems extends ListRecords
{
    protected static string $resource = PokokAjaranItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
