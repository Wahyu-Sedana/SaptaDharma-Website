<?php

namespace Database\Seeders;

use App\Models\HistoryTimeline;
use Illuminate\Database\Seeder;

class HistoryTimelineSeeder extends Seeder
{
    public function run(): void
    {
        $timeline = [
            [
                'year' => '1952',
                'title' => ['id' => 'Wahyu Pertama Diterima', 'en' => 'The First Revelation'],
                'description' => [
                    'id' => 'Sri Gutama menerima wahyu yang menjadi awal mula ajaran Sapta Darma.',
                    'en' => 'Sri Gutama received the revelation that marked the beginning of Sapta Darma teachings.',
                ],
                'icon' => 'fa-solid fa-star',
            ],
            [
                'year' => '1955',
                'title' => ['id' => 'Penetapan Nama Sapta Darma', 'en' => 'The Name "Sapta Darma" Adopted'],
                'description' => [
                    'id' => 'Ajaran mulai disebarluaskan dengan nama Sapta Darma kepada masyarakat luas.',
                    'en' => 'The teachings began to be spread to the public under the name Sapta Darma.',
                ],
                'icon' => 'fa-solid fa-flag',
            ],
            [
                'year' => '1960',
                'title' => ['id' => 'Pendirian Sanggar Pertama', 'en' => 'The First Hall Established'],
                'description' => [
                    'id' => 'Sanggar candi busana pertama didirikan sebagai pusat kegiatan warga.',
                    'en' => 'The first candi busana hall was established as a center for member activities.',
                ],
                'icon' => 'fa-solid fa-place-of-worship',
            ],
            [
                'year' => '1980',
                'title' => ['id' => 'Penyebaran ke Berbagai Daerah', 'en' => 'Expansion Across the Region'],
                'description' => [
                    'id' => 'Sapta Darma berkembang dan memiliki sanggar di berbagai kota di Indonesia.',
                    'en' => 'Sapta Darma grew and established halls in various cities across Indonesia.',
                ],
                'icon' => 'fa-solid fa-map',
            ],
            [
                'year' => '2010',
                'title' => ['id' => 'Pengakuan sebagai Penghayat Kepercayaan', 'en' => 'Recognized as a Faith Community'],
                'description' => [
                    'id' => 'Sapta Darma diakui sebagai salah satu penghayat kepercayaan di Indonesia.',
                    'en' => 'Sapta Darma was recognized as one of the faith communities in Indonesia.',
                ],
                'icon' => 'fa-solid fa-certificate',
            ],
        ];

        foreach ($timeline as $index => $item) {
            $record = HistoryTimeline::where('year', $item['year'])
                ->where('title->id', $item['title']['id'])
                ->first() ?? new HistoryTimeline();

            $record->fill([
                'year' => $item['year'],
                'title' => $item['title'],
                'description' => $item['description'],
                'icon' => $item['icon'],
                'sort_order' => $index,
                'status' => 'publish',
            ])->save();
        }
    }
}
