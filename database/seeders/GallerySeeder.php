<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        if (Gallery::count() > 0) {
            return;
        }

        Gallery::factory()->count(8)->create();
    }
}
