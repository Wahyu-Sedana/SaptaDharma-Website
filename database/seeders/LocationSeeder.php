<?php

namespace Database\Seeders;

use App\Models\Location;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Sanggar Candi Busana Yogyakarta', 'address' => 'Jl. Kaliurang, Yogyakarta', 'latitude' => -7.7828, 'longitude' => 110.3671],
            ['name' => 'Sanggar Candi Busana Surabaya', 'address' => 'Jl. Diponegoro, Surabaya', 'latitude' => -7.2575, 'longitude' => 112.7521],
            ['name' => 'Sanggar Candi Busana Bandung', 'address' => 'Jl. Asia Afrika, Bandung', 'latitude' => -6.9175, 'longitude' => 107.6191],
            ['name' => 'Sanggar Candi Busana Denpasar', 'address' => 'Jl. Gajah Mada, Denpasar', 'latitude' => -8.6705, 'longitude' => 115.2126],
        ];

        foreach ($locations as $index => $location) {
            $record = Location::where('name->id', $location['name'])->first() ?? new Location();

            $record->fill([
                'name' => ['id' => $location['name'], 'en' => $location['name']],
                'image' => PlaceholderMedia::image('locations', Str::slug($location['name']), $location['name']),
                'address' => ['id' => $location['address'], 'en' => $location['address']],
                'phone' => '0812-3456-' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'maps_link' => null,
                'open_time' => '08:00',
                'close_time' => '17:00',
                'sort_order' => $index,
                'status' => 'publish',
            ])->save();
        }
    }
}
