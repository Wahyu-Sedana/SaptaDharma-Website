<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGallery extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = GalleryResource::class;
}
