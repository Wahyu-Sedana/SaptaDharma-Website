<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Section;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{
    public function definition(): array
    {
        $titleId = fake()->sentence(4);

        return [
            'page_id' => Page::factory(),
            'slug' => Str::slug($titleId) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'title' => ['id' => $titleId, 'en' => fake()->sentence(4)],
            'subtitle' => ['id' => fake()->sentence(10), 'en' => fake()->sentence(10)],
            'description' => ['id' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'image' => PlaceholderMedia::image('sections', Str::random(12), $titleId),
            'button_text' => null,
            'button_link' => null,
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
