<?php

namespace Database\Factories;

use App\Models\HistoryTimeline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HistoryTimeline>
 */
class HistoryTimelineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'year' => (string) fake()->numberBetween(1950, (int) date('Y')),
            'title' => ['id' => fake()->sentence(4), 'en' => fake()->sentence(4)],
            'description' => ['id' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'icon' => 'fa-solid fa-flag',
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
