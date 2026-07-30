<?php

namespace Database\Factories;

use App\Models\Location;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    public function definition(): array
    {
        $name = 'Sanggar Candi Busana ' . fake()->city();
        $address = fake()->address();

        return [
            'name' => ['id' => $name, 'en' => $name],
            'image' => PlaceholderMedia::image('locations', Str::random(12), $name),
            'address' => ['id' => $address, 'en' => $address],
            'phone' => fake()->phoneNumber(),
            'latitude' => fake()->latitude(-8, -6),
            'longitude' => fake()->longitude(106, 115),
            'maps_link' => null,
            'open_time' => '08:00',
            'close_time' => '17:00',
            'sort_order' => 0,
            'status' => 'publish',
        ];
    }
}
