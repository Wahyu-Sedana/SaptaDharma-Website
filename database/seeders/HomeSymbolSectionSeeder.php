<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

/**
 * Creates the two homepage sections introduced by the "Simbol Pribadi Manusia"
 * redesign. Uses firstOrCreate (not updateOrCreate) so re-running this in an
 * environment where an admin has already edited these sections never
 * overwrites their changes — it only fills in the rows if they're missing.
 */
class HomeSymbolSectionSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::where('slug', 'home')->first();

        if (! $page) {
            return;
        }

        $maxSortOrder = Section::where('page_id', $page->id)->max('sort_order') ?? 0;

        $sections = [
            [
                'slug' => 'home-symbol',
                'title' => ['id' => 'Simbol Pribadi Manusia', 'en' => 'Symbol of Human Personality'],
                'subtitle' => ['id' => '', 'en' => ''],
                'description' => [
                    'id' => 'Simbol Pribadi Manusia adalah lambang suci Sapta Darma yang menggambarkan sujud manusia dalam mendekatkan diri kepada Tuhan Yang Maha Esa, sekaligus menjadi tuntunan hidup menuju kebenaran dan kesempurnaan.',
                    'en' => 'The Symbol of Human Personality is the sacred emblem of Sapta Darma, depicting human submission in drawing closer to God Almighty, and serving as a guide toward truth and perfection.',
                ],
            ],
            [
                'slug' => 'home-sasanti',
                'title' => ['id' => 'Sasanti', 'en' => 'Sasanti'],
                'subtitle' => ['id' => '', 'en' => ''],
                'description' => [
                    'id' => 'Hidup dalam kebenaran, berkarya untuk kemanusiaan.',
                    'en' => 'Living in truth, working for humanity.',
                ],
            ],
        ];

        foreach ($sections as $offset => $section) {
            Section::firstOrCreate(
                ['slug' => $section['slug']],
                [
                    'page_id' => $page->id,
                    'title' => $section['title'],
                    'subtitle' => $section['subtitle'],
                    'description' => $section['description'],
                    'sort_order' => $maxSortOrder + $offset + 1,
                    'status' => 'publish',
                ]
            );
        }
    }
}
