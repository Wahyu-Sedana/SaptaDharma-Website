<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        ArticleCategory::all()->each(function (ArticleCategory $category) {
            if ($category->articles()->count() > 0) {
                return;
            }

            Article::factory()
                ->count(3)
                ->create(['category_id' => $category->id]);
        });
    }
}
