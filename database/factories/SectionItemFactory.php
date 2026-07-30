<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\SectionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SectionItem>
 */
class SectionItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'section_id' => Section::factory(),
            'title' => ['id' => fake()->sentence(3), 'en' => fake()->sentence(3)],
            'description' => ['id' => fake()->sentence(15), 'en' => fake()->sentence(15)],
            'icon' => 'fa-solid fa-star',
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
