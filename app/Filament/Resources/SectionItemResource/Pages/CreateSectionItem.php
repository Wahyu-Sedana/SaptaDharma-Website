<?php

namespace App\Filament\Resources\SectionItemResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\SectionItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSectionItem extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = SectionItemResource::class;
}
