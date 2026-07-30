<?php

namespace App\Filament\Resources\HeroResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\HeroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHero extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = HeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
