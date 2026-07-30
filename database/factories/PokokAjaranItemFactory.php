<?php

namespace Database\Factories;

use App\Models\PokokAjaran;
use App\Models\PokokAjaranItem;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PokokAjaranItem>
 */
class PokokAjaranItemFactory extends Factory
{
    public function definition(): array
    {
        $titleId = fake()->sentence(4);

        return [
            'pokok_ajaran_id' => PokokAjaran::factory(),
            'title' => ['id' => $titleId, 'en' => fake()->sentence(4)],
            'image' => PlaceholderMedia::image('pokok-ajaran-items', Str::random(12), $titleId),
            'description' => ['id' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'quote' => ['id' => fake()->sentence(12), 'en' => fake()->sentence(12)],
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
