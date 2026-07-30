<?php

namespace Database\Factories;

use App\Models\PokokAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PokokAjaran>
 */
class PokokAjaranFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ['id' => fake()->sentence(4), 'en' => fake()->sentence(4)],
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
