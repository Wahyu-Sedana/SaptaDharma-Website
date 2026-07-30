<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'publisher',
        'isbn',
        'year',
        'cover',
        'pdf',
        'description',
        'views',
        'downloads',
        'sort_order',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }
}
