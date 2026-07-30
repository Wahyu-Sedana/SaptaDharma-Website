<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BookCategory extends Model
{
    /** @use HasFactory<\Database\Factories\BookCategoryFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}
