<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        BookCategory::all()->each(function (BookCategory $category) {
            if ($category->books()->count() > 0) {
                return;
            }

            Book::factory()
                ->count(3)
                ->create(['category_id' => $category->id]);
        });
    }
}
