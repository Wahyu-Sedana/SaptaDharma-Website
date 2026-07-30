<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Home',
                'slug' => 'home',
            ],
            [
                'name' => 'Ajaran',
                'slug' => 'teachings',
            ],
            [
                'name' => 'Sejarah',
                'slug' => 'history',
            ],
            [
                'name' => 'Artikel',
                'slug' => 'articles',
            ],
            [
                'name' => 'Buku',
                'slug' => 'books',
            ],
            [
                'name' => 'Lokasi',
                'slug' => 'locations',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
