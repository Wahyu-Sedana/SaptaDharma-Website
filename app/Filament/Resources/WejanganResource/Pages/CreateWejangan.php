<?php

namespace App\Filament\Resources\WejanganResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\WejanganResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWejangan extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = WejanganResource::class;
}
