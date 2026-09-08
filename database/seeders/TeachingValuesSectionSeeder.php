<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

class TeachingValuesSectionSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::where('slug', 'teachings')->first();

        if (! $page) {
            return;
        }

        $maxSortOrder = Section::where('page_id', $page->id)->max('sort_order') ?? 0;

        Section::firstOrCreate(
            ['slug' => 'teaching-nilai-nilai-luhur'],
            [
                'page_id' => $page->id,
                'title' => ['id' => 'Wewarah Tujuh', 'en' => 'The Seven Teachings'],
                'subtitle' => ['id' => 'Ajaran', 'en' => 'Teachings'],
                'description' => [
                    'id' => 'Nilai-nilai budi luhur yang menjadi pedoman perilaku warga Sapta Darma sehari-hari.',
                    'en' => 'The noble values that guide the daily conduct of Sapta Darma members.',
                ],
                'sort_order' => $maxSortOrder + 1,
                'status' => 'publish',
            ]
        );
    }
}
