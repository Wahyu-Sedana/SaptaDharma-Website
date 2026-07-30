<?php

namespace App\Filament\Resources\LocationResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\LocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLocation extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = LocationResource::class;
}
