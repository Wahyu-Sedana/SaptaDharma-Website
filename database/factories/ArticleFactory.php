<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use App\Models\Article;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $titleId = fake()->unique()->sentence(6);

        return [
            'category_id' => ArticleCategory::factory(),
            'title' => ['id' => $titleId, 'en' => fake()->sentence(6)],
            'slug' => Str::slug($titleId) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'image' => PlaceholderMedia::image('articles', Str::random(12), $titleId),
            'content' => [
                'id' => '<p>' . implode('</p><p>', fake()->paragraphs(5)) . '</p>',
                'en' => '<p>' . implode('</p><p>', fake()->paragraphs(5)) . '</p>',
            ],
            'author' => fake()->name(),
            'views' => fake()->numberBetween(0, 500),
            'status' => 'publish',
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
