<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ArticleCategory>
 */
class ArticleCategoryFactory extends Factory
{
    public function definition(): array
    {
        $nameId = ucfirst(fake()->unique()->words(2, true));

        return [
            'name' => ['id' => $nameId, 'en' => ucfirst(fake()->words(2, true))],
            'slug' => Str::slug($nameId),
        ];
    }
}
