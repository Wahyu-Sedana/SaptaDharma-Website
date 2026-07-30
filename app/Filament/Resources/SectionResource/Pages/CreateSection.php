<?php

namespace App\Filament\Resources\SectionResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSection extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = SectionResource::class;
}
