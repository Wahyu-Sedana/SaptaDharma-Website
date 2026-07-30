<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'subtitle', 'description', 'button_text'];

    protected $fillable = [
        'page_id',
        'slug',
        'title',
        'subtitle',
        'description',
        'image',
        'button_text',
        'button_link',
        'sort_order',
        'status',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function items()
    {
        return $this->hasMany(SectionItem::class)
            ->orderBy('sort_order');
    }
}
