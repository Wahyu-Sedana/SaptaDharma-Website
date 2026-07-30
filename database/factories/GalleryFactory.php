<?php

namespace Database\Factories;

use App\Models\Gallery;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    public function definition(): array
    {
        $titleId = fake()->sentence(3);

        return [
            'title' => ['id' => $titleId, 'en' => fake()->sentence(3)],
            'image' => PlaceholderMedia::image('galleries', Str::random(12), $titleId),
            'description' => ['id' => fake()->sentence(10), 'en' => fake()->sentence(10)],
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
