<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = BookResource::class;
}
