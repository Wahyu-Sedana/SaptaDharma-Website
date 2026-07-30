<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 'Ajaran Pokok', 'en' => 'Core Teachings'],
            ['id' => 'Sejarah', 'en' => 'History'],
            ['id' => 'Renungan', 'en' => 'Reflections'],
            ['id' => 'Umum', 'en' => 'General'],
        ];

        foreach ($categories as $name) {
            BookCategory::updateOrCreate(
                ['slug' => Str::slug($name['id'])],
                ['name' => $name]
            );
        }
    }
}
