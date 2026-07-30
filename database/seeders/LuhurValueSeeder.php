<?php

namespace Database\Seeders;

use App\Models\LuhurValue;
use Illuminate\Database\Seeder;

class LuhurValueSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            [
                'title' => ['id' => 'Jujur', 'en' => 'Honest'],
                'icon' => 'fa-solid fa-scale-balanced',
                'description' => [
                    'id' => 'Berkata dan bertindak dengan jujur dalam segala hal.',
                    'en' => 'Speaking and acting honestly in all things.',
                ],
            ],
            [
                'title' => ['id' => 'Ikhlas', 'en' => 'Sincere'],
                'icon' => 'fa-solid fa-hand-holding-heart',
                'description' => [
                    'id' => 'Berbuat baik tanpa mengharap imbalan.',
                    'en' => 'Doing good without expecting anything in return.',
                ],
            ],
            [
                'title' => ['id' => 'Sabar', 'en' => 'Patient'],
                'icon' => 'fa-solid fa-leaf',
                'description' => [
                    'id' => 'Menghadapi setiap ujian hidup dengan hati yang tenang.',
                    'en' => 'Facing every trial of life with a calm heart.',
                ],
            ],
            [
                'title' => ['id' => 'Rukun', 'en' => 'Harmonious'],
                'icon' => 'fa-solid fa-people-arrows',
                'description' => [
                    'id' => 'Menjaga kerukunan dengan sesama tanpa membeda-bedakan.',
                    'en' => 'Maintaining harmony with others without discrimination.',
                ],
            ],
            [
                'title' => ['id' => 'Waspada', 'en' => 'Vigilant'],
                'icon' => 'fa-solid fa-eye',
                'description' => [
                    'id' => 'Senantiasa berhati-hati dan sadar dalam bertindak.',
                    'en' => 'Always being careful and mindful in action.',
                ],
            ],
        ];

        foreach ($values as $index => $value) {
            $luhurValue = LuhurValue::where('title->id', $value['title']['id'])->first() ?? new LuhurValue();

            $luhurValue->fill([
                'title' => $value['title'],
                'description' => $value['description'],
                'icon' => $value['icon'],
                'sort_order' => $index,
                'status' => 'publish',
            ])->save();
        }
    }
}
