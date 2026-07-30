<?php

namespace App\Filament\Resources\FounderResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\FounderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFounder extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = FounderResource::class;
}
