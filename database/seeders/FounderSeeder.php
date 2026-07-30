<?php

namespace Database\Seeders;

use App\Models\Founder;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FounderSeeder extends Seeder
{
    public function run(): void
    {
        $founders = [
            [
                'name' => 'Sri Gutama',
                'position' => ['id' => 'Panuntun Agung', 'en' => 'Panuntun Agung (Grand Guide)'],
                'description' => [
                    'id' => 'Penerima wahyu pertama yang menjadi cikal bakal berdirinya Sapta Darma.',
                    'en' => 'The first to receive the revelation that became the origin of Sapta Darma.',
                ],
            ],
            [
                'name' => 'Ki Hardjosapoero',
                'position' => ['id' => 'Pinisepuh', 'en' => 'Pinisepuh (Elder)'],
                'description' => [
                    'id' => 'Tokoh yang berperan besar dalam penyebaran ajaran Sapta Darma di berbagai daerah.',
                    'en' => 'A key figure in spreading the teachings of Sapta Darma across many regions.',
                ],
            ],
            [
                'name' => 'Ibu Sri Pawenang',
                'position' => ['id' => 'Pinisepuh', 'en' => 'Pinisepuh (Elder)'],
                'description' => [
                    'id' => 'Menuliskan dan membukukan ajaran Sapta Darma agar dapat dipelajari generasi berikutnya.',
                    'en' => 'Documented and compiled the teachings of Sapta Darma for future generations to study.',
                ],
            ],
        ];

        foreach ($founders as $index => $founder) {
            $record = Founder::where('name->id', $founder['name'])->first() ?? new Founder();

            $record->fill([
                'name' => ['id' => $founder['name'], 'en' => $founder['name']],
                'position' => $founder['position'],
                'image' => PlaceholderMedia::image('founders', Str::slug($founder['name']), $founder['name'], 800, 800),
                'description' => $founder['description'],
                'sort_order' => $index,
                'status' => 'publish',
            ])->save();
        }
    }
}
