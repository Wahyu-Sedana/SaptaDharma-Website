<?php

namespace Database\Factories;

use App\Models\Founder;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Founder>
 */
class FounderFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => ['id' => $name, 'en' => $name],
            'position' => fake()->randomElement([
                ['id' => 'Ketua Sanggar', 'en' => 'Hall Chairperson'],
                ['id' => 'Wakil Ketua', 'en' => 'Vice Chairperson'],
                ['id' => 'Pinisepuh', 'en' => 'Elder'],
                ['id' => 'Sekretaris', 'en' => 'Secretary'],
                ['id' => 'Bendahara', 'en' => 'Treasurer'],
            ]),
            'image' => PlaceholderMedia::image('founders', Str::random(12), $name, 800, 800),
            'description' => ['id' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
