<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Concerns\RedirectsToIndex;
use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = ArticleResource::class;
}
