<?php

namespace App\Filament\Resources\PokokAjaranResource\Pages;

use App\Filament\Resources\PokokAjaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPokokAjarans extends ListRecords
{
    protected static string $resource = PokokAjaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
