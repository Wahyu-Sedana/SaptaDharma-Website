<?php

namespace App\Filament\Resources\PokokAjaranResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\PokokAjaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePokokAjaran extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = PokokAjaranResource::class;
}
