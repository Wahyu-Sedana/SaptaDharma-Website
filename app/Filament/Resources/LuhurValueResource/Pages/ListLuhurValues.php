<?php

namespace App\Filament\Resources\LuhurValueResource\Pages;

use App\Filament\Resources\LuhurValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLuhurValues extends ListRecords
{
    protected static string $resource = LuhurValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
