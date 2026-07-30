<?php

namespace App\Filament\Resources\HeroResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\HeroResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHero extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = HeroResource::class;
}
