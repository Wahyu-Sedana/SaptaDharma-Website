<?php

namespace App\Filament\Resources\WejanganResource\Pages;

use App\Filament\Resources\WejanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWejangans extends ListRecords
{
    protected static string $resource = WejanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
