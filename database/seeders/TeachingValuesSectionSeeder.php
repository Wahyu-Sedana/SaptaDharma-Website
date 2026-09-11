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
                    'id' => 'Kewajiban Warga Sapta Darma',
                    'en' => 'Duties of Sapta Darma Members',
                ],
                'sort_order' => $maxSortOrder + 1,
                'status' => 'publish',
            ]
        );
    }
}
