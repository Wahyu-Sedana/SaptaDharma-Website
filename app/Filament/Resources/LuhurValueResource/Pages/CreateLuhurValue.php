<?php

namespace App\Filament\Resources\LuhurValueResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\LuhurValueResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLuhurValue extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = LuhurValueResource::class;
}
