<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hero extends Model
{
    /** @use HasFactory<\Database\Factories\HeroFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'subtitle'];

    protected $fillable = [
        'page_id',
        'title',
        'subtitle',
        'image',
        'video',
        'status'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
