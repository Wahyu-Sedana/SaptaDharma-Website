<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionItem;
use Illuminate\Database\Seeder;

class SectionItemSeeder extends Seeder
{
    public function run(): void
    {
        $aboutSection = Section::where('slug', 'home-about')->first();

        if (! $aboutSection) {
            return;
        }

        $items = [
            [
                'icon' => 'fa-solid fa-pray',
                'title' => ['id' => 'Sujud', 'en' => 'Prostration'],
                'description' => [
                    'id' => 'Laku utama untuk mendekatkan diri kepada Tuhan Yang Maha Esa.',
                    'en' => 'The main practice for drawing closer to God Almighty.',
                ],
            ],
            [
                'icon' => 'fa-solid fa-heart',
                'title' => ['id' => 'Budi Luhur', 'en' => 'Noble Character'],
                'description' => [
                    'id' => 'Menjunjung tinggi nilai-nilai budi luhur dalam kehidupan sehari-hari.',
                    'en' => 'Upholding noble values in everyday life.',
                ],
            ],
            [
                'icon' => 'fa-solid fa-hands-praying',
                'title' => ['id' => 'Racut', 'en' => 'Racut'],
                'description' => [
                    'id' => 'Melatih kepekaan rasa dan kesadaran diri secara rohani.',
                    'en' => 'Training inner sensitivity and spiritual self-awareness.',
                ],
            ],
            [
                'icon' => 'fa-solid fa-people-group',
                'title' => ['id' => 'Kegotongroyongan', 'en' => 'Mutual Cooperation'],
                'description' => [
                    'id' => 'Mengabdi dan bergotong royong bagi sesama serta lingkungan sekitar.',
                    'en' => 'Serving and working together for others and the surrounding community.',
                ],
            ],
        ];

        foreach ($items as $index => $item) {
            $sectionItem = SectionItem::where('section_id', $aboutSection->id)
                ->where('icon', $item['icon'])
                ->first() ?? new SectionItem(['section_id' => $aboutSection->id]);

            $sectionItem->fill([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'description' => $item['description'],
                'sort_order' => $index,
                'status' => 'publish',
            ])->save();
        }
    }
}
