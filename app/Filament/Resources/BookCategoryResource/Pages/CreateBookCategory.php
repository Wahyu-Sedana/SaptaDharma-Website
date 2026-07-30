<?php

namespace App\Filament\Resources\BookCategoryResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\BookCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookCategory extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = BookCategoryResource::class;
}
