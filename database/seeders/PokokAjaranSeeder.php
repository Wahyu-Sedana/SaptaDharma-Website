<?php

namespace Database\Seeders;

use App\Models\PokokAjaran;
use App\Models\PokokAjaranItem;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PokokAjaranSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => [
                    'id' => 'Percaya dan Taqwa kepada Tuhan Yang Maha Esa',
                    'en' => 'Believing in and Devoted to God Almighty',
                ],
                'description' => [
                    'id' => 'Meyakini dan berbakti kepada Tuhan Yang Maha Esa sebagai landasan utama kehidupan.',
                    'en' => 'Believing in and devoting oneself to God Almighty as the foundation of life.',
                ],
                'quote' => [
                    'id' => 'Sujud adalah jalan mendekatkan diri kepada Sang Pencipta.',
                    'en' => 'Sujud is the path to drawing closer to the Creator.',
                ],
            ],
            [
                'title' => [
                    'id' => 'Setia kepada Pemerintah dan Negara',
                    'en' => 'Loyal to the Government and the Nation',
                ],
                'description' => [
                    'id' => 'Menjunjung tinggi kesetiaan kepada bangsa dan negara Kesatuan Republik Indonesia.',
                    'en' => 'Upholding loyalty to the nation and the Unitary State of the Republic of Indonesia.',
                ],
                'quote' => [
                    'id' => 'Cinta tanah air adalah bagian dari laku hidup yang luhur.',
                    'en' => 'Love for one\'s country is part of a noble way of life.',
                ],
            ],
            [
                'title' => [
                    'id' => 'Ikut serta dalam Usaha-Usaha Menegakkan Hukum Negara',
                    'en' => 'Participating in Upholding the Law',
                ],
                'description' => [
                    'id' => 'Berperan aktif menjaga ketertiban dan kepatuhan terhadap hukum yang berlaku.',
                    'en' => 'Playing an active role in maintaining order and compliance with the law.',
                ],
                'quote' => [
                    'id' => 'Ketertiban adalah wujud nyata budi luhur dalam bermasyarakat.',
                    'en' => 'Order is a real manifestation of noble character in society.',
                ],
            ],
            [
                'title' => [
                    'id' => 'Ikut serta Menjaga Ketertiban dan Keamanan Masyarakat',
                    'en' => 'Helping to Maintain Public Order and Safety',
                ],
                'description' => [
                    'id' => 'Turut menjaga kerukunan dan keamanan lingkungan sekitar.',
                    'en' => 'Helping to maintain harmony and safety in the surrounding community.',
                ],
                'quote' => [
                    'id' => 'Keamanan bersama tercipta dari kepedulian setiap warga.',
                    'en' => 'Shared safety comes from the care of every member.',
                ],
            ],
            [
                'title' => [
                    'id' => 'Membantu Fakir Miskin dan Anak Terlantar',
                    'en' => 'Helping the Poor and Neglected Children',
                ],
                'description' => [
                    'id' => 'Mengulurkan bantuan kepada sesama yang membutuhkan sebagai wujud kasih sesama.',
                    'en' => 'Extending help to those in need as an expression of compassion.',
                ],
                'quote' => [
                    'id' => 'Berbagi adalah cermin dari budi luhur yang sesungguhnya.',
                    'en' => 'Sharing is a true reflection of noble character.',
                ],
            ],
            [
                'title' => [
                    'id' => 'Membudidayakan Sikap Gotong Royong',
                    'en' => 'Cultivating a Spirit of Mutual Cooperation',
                ],
                'description' => [
                    'id' => 'Mengutamakan kerja sama dan kebersamaan dalam setiap kegiatan masyarakat.',
                    'en' => 'Prioritizing cooperation and togetherness in every community activity.',
                ],
                'quote' => [
                    'id' => 'Gotong royong meringankan segala pekerjaan.',
                    'en' => 'Mutual cooperation lightens every task.',
                ],
            ],
            [
                'title' => [
                    'id' => 'Berbudi Luhur, Menuju Kesempurnaan Hidup',
                    'en' => 'Noble Character, Toward a Perfect Life',
                ],
                'description' => [
                    'id' => 'Senantiasa melatih diri berperilaku luhur menuju keselarasan hidup lahir dan batin.',
                    'en' => 'Continuously training oneself to act nobly toward inner and outer harmony.',
                ],
                'quote' => [
                    'id' => 'Kesempurnaan hidup dicapai melalui laku dan budi yang luhur.',
                    'en' => 'A perfect life is achieved through noble conduct and character.',
                ],
            ],
        ];

        $pokokAjaran = PokokAjaran::where('title->id', 'Wewarah Tujuh')->first() ?? new PokokAjaran();

        $pokokAjaran->fill([
            'title' => ['id' => 'Wewarah Tujuh', 'en' => 'The Seven Teachings'],
            'sort_order' => 0,
            'status' => 'publish',
        ])->save();

        foreach ($items as $index => $item) {
            $slug = Str::slug($item['title']['id']);

            $pokokAjaranItem = PokokAjaranItem::where('pokok_ajaran_id', $pokokAjaran->id)
                ->where('title->id', $item['title']['id'])
                ->first() ?? new PokokAjaranItem(['pokok_ajaran_id' => $pokokAjaran->id]);

            $pokokAjaranItem->fill([
                'title' => $item['title'],
                'image' => PlaceholderMedia::image('pokok-ajaran-items', $slug, $item['title']['id']),
                'description' => $item['description'],
                'quote' => $item['quote'],
                'sort_order' => $index,
                'status' => 'publish',
            ])->save();
        }
    }
}
