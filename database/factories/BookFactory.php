<?php

namespace Database\Factories;

use App\Models\BookCategory;
use App\Models\Book;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        $titleId = fake()->unique()->sentence(4);

        return [
            'category_id' => BookCategory::factory(),
            'title' => ['id' => $titleId, 'en' => fake()->sentence(4)],
            'slug' => Str::slug($titleId) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'isbn' => fake()->isbn13(),
            'year' => fake()->numberBetween(1990, (int) date('Y')),
            'cover' => PlaceholderMedia::image('books/covers', Str::random(12), $titleId, 800, 1200),
            'pdf' => PlaceholderMedia::pdf('books/pdf', Str::random(12), $titleId),
            'description' => [
                'id' => '<p>' . implode('</p><p>', fake()->paragraphs(3)) . '</p>',
                'en' => '<p>' . implode('</p><p>', fake()->paragraphs(3)) . '</p>',
            ],
            'views' => fake()->numberBetween(0, 300),
            'downloads' => fake()->numberBetween(0, 150),
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
