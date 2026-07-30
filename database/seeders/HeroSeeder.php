<?php

namespace Database\Seeders;

use App\Models\Hero;
use App\Models\Page;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroes = [
            'home' => [
                'title' => [
                    'id' => "Sapta Darma\nJalan Menuju Kesempurnaan Hidup",
                    'en' => "Sapta Darma\nThe Path to a Perfect Life",
                ],
                'subtitle' => [
                    'id' => 'Wadah kerohanian yang membimbing manusia menemukan jati diri, budi luhur, dan keselarasan hidup lahir batin bagi generasi sekarang dan mendatang.',
                    'en' => 'A spiritual community guiding people toward self-realization, noble character, and inner harmony for present and future generations.',
                ],
            ],
            'teachings' => [
                'title' => [
                    'id' => "Ajaran\nSapta Darma",
                    'en' => "Teachings of\nSapta Darma",
                ],
                'subtitle' => [
                    'id' => 'Tujuh wahyu suci yang menjadi pedoman hidup warga Sapta Darma dalam menempuh jalan kerohanian menuju budi luhur.',
                    'en' => 'Seven sacred revelations that guide the daily life of Sapta Darma members on their spiritual path toward noble character.',
                ],
            ],
            'history' => [
                'title' => [
                    'id' => "Sejarah\nSapta Darma",
                    'en' => "History of\nSapta Darma",
                ],
                'subtitle' => [
                    'id' => 'Menelusuri perjalanan lahirnya Sapta Darma sejak wahyu pertama diterima hingga berkembang di seluruh penjuru Nusantara.',
                    'en' => 'Tracing the origins of Sapta Darma from the first revelation to its growth across the Indonesian archipelago.',
                ],
            ],
            'articles' => [
                'title' => [
                    'id' => "Artikel &\nWawasan",
                    'en' => "Articles &\nInsights",
                ],
                'subtitle' => [
                    'id' => 'Kumpulan tulisan seputar ajaran, kegiatan, dan renungan kerohanian Sapta Darma untuk memperkaya wawasan batin.',
                    'en' => 'A collection of writings on the teachings, activities, and spiritual reflections of Sapta Darma.',
                ],
            ],
            'books' => [
                'title' => [
                    'id' => 'Perpustakaan Sapta Darma',
                    'en' => 'Sapta Darma Library',
                ],
                'subtitle' => [
                    'id' => 'Kumpulan buku dan pustaka ajaran Sapta Darma sebagai sumber belajar dan pegangan warga dalam laku kerohanian.',
                    'en' => 'A collection of books and references on Sapta Darma teachings, used as a source of learning for its members.',
                ],
            ],
            'locations' => [
                'title' => [
                    'id' => 'Sanggar Candi Busana',
                    'en' => 'Candi Busana Halls',
                ],
                'subtitle' => [
                    'id' => 'Temukan lokasi sanggar candi busana Sapta Darma terdekat di kota Anda untuk mengikuti sujud dan kegiatan kerohanian.',
                    'en' => 'Find the nearest Sapta Darma candi busana hall in your city to join sujud and other spiritual activities.',
                ],
            ],
        ];

        foreach ($heroes as $slug => $hero) {
            $page = Page::where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            $existing = Hero::where('page_id', $page->id)->first();
            $image = $existing?->image;

            if (! $image || ! Storage::disk('public')->exists($image)) {
                $image = PlaceholderMedia::image('heroes', $slug, "Sapta Darma - {$slug}", 1920, 1080);
            }

            Hero::updateOrCreate(
                ['page_id' => $page->id],
                [
                    'title' => $hero['title'],
                    'subtitle' => $hero['subtitle'],
                    'image' => $image,
                    'status' => 'publish',
                ]
            );
        }
    }
}
