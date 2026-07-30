<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 'Ajaran', 'en' => 'Teachings'],
            ['id' => 'Sejarah', 'en' => 'History'],
            ['id' => 'Kegiatan', 'en' => 'Activities'],
            ['id' => 'Renungan', 'en' => 'Reflections'],
            ['id' => 'Berita', 'en' => 'News'],
        ];

        foreach ($categories as $name) {
            ArticleCategory::updateOrCreate(
                ['slug' => Str::slug($name['id'])],
                ['name' => $name]
            );
        }
    }
}
