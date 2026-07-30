<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            'home' => [
                [
                    'slug' => 'home-about',
                    'title' => ['id' => 'Tentang Sapta Darma', 'en' => 'About Sapta Darma'],
                    'subtitle' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
                    'description' => [
                        'id' => '<p>Sapta Darma adalah wadah kerohanian yang membimbing warganya untuk hidup dengan budi luhur, mengabdi kepada sesama, dan menjalankan sujud sebagai laku utama menuju keselarasan hidup lahir batin.</p>',
                        'en' => '<p>Sapta Darma is a spiritual community that guides its members to live with noble character, serve others, and practice sujud as the main path toward inner harmony.</p>',
                    ],
                    'button_text' => ['id' => 'Selengkapnya', 'en' => 'Learn More'],
                    'button_link' => '/sejarah',
                ],
                [
                    'slug' => 'home-latest-articles',
                    'title' => ['id' => 'Artikel Terbaru', 'en' => 'Latest Articles'],
                    'subtitle' => ['id' => 'Wawasan', 'en' => 'Insights'],
                    'description' => [
                        'id' => 'Tulisan dan renungan terbaru seputar ajaran dan kegiatan Sapta Darma.',
                        'en' => 'The latest writings and reflections on Sapta Darma teachings and activities.',
                    ],
                    'button_text' => ['id' => 'Lihat Semua Artikel', 'en' => 'View All Articles'],
                    'button_link' => '/artikel',
                ],
                [
                    'slug' => 'home-latest-books',
                    'title' => ['id' => 'Buku Terbaru', 'en' => 'Latest Books'],
                    'subtitle' => ['id' => 'Pustaka', 'en' => 'Library'],
                    'description' => [
                        'id' => 'Kumpulan buku dan pustaka ajaran Sapta Darma yang dapat dipelajari.',
                        'en' => 'A collection of books and references on Sapta Darma teachings.',
                    ],
                    'button_text' => ['id' => 'Lihat Semua Buku', 'en' => 'View All Books'],
                    'button_link' => '/buku',
                ],
                [
                    'slug' => 'home-locations',
                    'title' => ['id' => 'Sanggar Candi Busana', 'en' => 'Candi Busana Halls'],
                    'subtitle' => ['id' => 'Lokasi', 'en' => 'Locations'],
                    'description' => [
                        'id' => 'Temukan sanggar candi busana Sapta Darma terdekat di kota Anda.',
                        'en' => 'Find the nearest Sapta Darma candi busana hall in your city.',
                    ],
                    'button_text' => ['id' => 'Lihat Semua Lokasi', 'en' => 'View All Locations'],
                    'button_link' => '/lokasi',
                ],
            ],
            'teachings' => [
                [
                    'slug' => 'teaching-nilai-nilai-luhur',
                    'title' => ['id' => 'Nilai-Nilai Budi Luhur', 'en' => 'Noble Values'],
                    'subtitle' => ['id' => 'Ajaran', 'en' => 'Teachings'],
                    'description' => [
                        'id' => 'Nilai-nilai budi luhur yang menjadi pedoman perilaku warga Sapta Darma sehari-hari.',
                        'en' => 'The noble values that guide the daily conduct of Sapta Darma members.',
                    ],
                ],
                [
                    'slug' => 'teaching-pokok-ajaran',
                    'title' => ['id' => 'Pokok-Pokok Ajaran', 'en' => 'Core Teachings'],
                    'subtitle' => ['id' => 'Ajaran', 'en' => 'Teachings'],
                    'description' => [
                        'id' => 'Pokok-pokok ajaran Sapta Darma sebagai tuntunan laku kerohanian.',
                        'en' => 'The core teachings of Sapta Darma as a guide for spiritual practice.',
                    ],
                ],
            ],
            'history' => [
                [
                    'slug' => 'history-about',
                    'title' => ['id' => 'Sejarah Sapta Darma', 'en' => 'History of Sapta Darma'],
                    'subtitle' => ['id' => 'Sejarah', 'en' => 'History'],
                    'description' => [
                        'id' => '<p>Sapta Darma lahir dari wahyu yang diterima Panuntun Agung Sri Gutama, dan terus berkembang hingga menjangkau warga di seluruh Nusantara.</p>',
                        'en' => '<p>Sapta Darma was born from a revelation received by Panuntun Agung Sri Gutama, and has since grown to reach members across the Indonesian archipelago.</p>',
                    ],
                ],
                [
                    'slug' => 'history-timeline',
                    'title' => ['id' => 'Garis Waktu Perjalanan', 'en' => 'Timeline'],
                    'subtitle' => ['id' => 'Timeline', 'en' => 'Timeline'],
                    'description' => [
                        'id' => 'Tonggak-tonggak penting dalam perjalanan Sapta Darma dari masa ke masa.',
                        'en' => 'Key milestones in the journey of Sapta Darma through the years.',
                    ],
                ],
                [
                    'slug' => 'history-founder',
                    'title' => ['id' => 'Tokoh Pendiri', 'en' => 'Founders'],
                    'subtitle' => ['id' => 'Profil', 'en' => 'Profiles'],
                    'description' => [
                        'id' => 'Tokoh-tokoh yang berperan dalam berdirinya dan berkembangnya Sapta Darma.',
                        'en' => 'The figures who played a role in founding and growing Sapta Darma.',
                    ],
                ],
            ],
            'articles' => [
                [
                    'slug' => 'article-featured',
                    'title' => ['id' => 'Artikel Pilihan', 'en' => 'Featured Article'],
                    'subtitle' => ['id' => 'Sorotan', 'en' => 'Highlight'],
                    'description' => [
                        'id' => 'Artikel pilihan yang paling banyak dibaca warga Sapta Darma.',
                        'en' => 'The most-read featured article among Sapta Darma members.',
                    ],
                ],
                [
                    'slug' => 'article-list',
                    'title' => ['id' => 'Semua Artikel', 'en' => 'All Articles'],
                    'subtitle' => ['id' => 'Artikel', 'en' => 'Articles'],
                    'description' => [
                        'id' => 'Kumpulan artikel seputar ajaran, sejarah, dan kegiatan Sapta Darma.',
                        'en' => 'A collection of articles on the teachings, history, and activities of Sapta Darma.',
                    ],
                ],
            ],
            'books' => [
                [
                    'slug' => 'book-list',
                    'title' => ['id' => 'Pustaka Sapta Darma', 'en' => 'Sapta Darma Library'],
                    'subtitle' => ['id' => 'Buku', 'en' => 'Books'],
                    'description' => [
                        'id' => 'Kumpulan buku dan pustaka ajaran Sapta Darma.',
                        'en' => 'A collection of books and references on Sapta Darma teachings.',
                    ],
                ],
            ],
            'locations' => [
                [
                    'slug' => 'location-list',
                    'title' => ['id' => 'Sanggar Candi Busana', 'en' => 'Candi Busana Halls'],
                    'subtitle' => ['id' => 'Lokasi', 'en' => 'Locations'],
                    'description' => [
                        'id' => 'Daftar sanggar candi busana Sapta Darma di berbagai kota.',
                        'en' => 'A list of Sapta Darma candi busana halls across different cities.',
                    ],
                ],
                [
                    'slug' => 'location-gallery',
                    'title' => ['id' => 'Galeri Sanggar', 'en' => 'Hall Gallery'],
                    'subtitle' => ['id' => 'Galeri', 'en' => 'Gallery'],
                    'description' => [
                        'id' => 'Dokumentasi kegiatan dan suasana di sanggar candi busana.',
                        'en' => 'Photos of activities and the atmosphere at the candi busana halls.',
                    ],
                ],
            ],
        ];

        foreach ($sections as $pageSlug => $pageSections) {
            $page = Page::where('slug', $pageSlug)->first();

            if (! $page) {
                continue;
            }

            foreach ($pageSections as $index => $section) {
                Section::updateOrCreate(
                    ['slug' => $section['slug']],
                    [
                        'page_id' => $page->id,
                        'title' => $section['title'],
                        'subtitle' => $section['subtitle'],
                        'description' => $section['description'],
                        'button_text' => $section['button_text'] ?? null,
                        'button_link' => $section['button_link'] ?? null,
                        'sort_order' => $index,
                        'status' => 'publish',
                    ]
                );
            }
        }
    }
}
