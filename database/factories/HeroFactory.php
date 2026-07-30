<?php

namespace Database\Factories;

use App\Models\Hero;
use App\Models\Page;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Hero>
 */
class HeroFactory extends Factory
{
    public function definition(): array
    {
        $titleId = fake()->sentence(4);

        return [
            'page_id' => Page::factory(),
            'title' => ['id' => $titleId, 'en' => fake()->sentence(4)],
            'subtitle' => ['id' => fake()->sentence(15), 'en' => fake()->sentence(15)],
            'image' => PlaceholderMedia::image('heroes', Str::random(12), $titleId, 1920, 1080),
            'video' => null,
            'status' => 'publish',
        ];
    }
}
