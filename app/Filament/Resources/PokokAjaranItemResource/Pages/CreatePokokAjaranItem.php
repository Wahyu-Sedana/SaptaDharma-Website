<?php

namespace App\Filament\Resources\PokokAjaranItemResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\PokokAjaranItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePokokAjaranItem extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = PokokAjaranItemResource::class;
}
