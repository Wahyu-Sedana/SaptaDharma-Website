<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SectionItem extends Model
{
    /** @use HasFactory<\Database\Factories\SectionItemFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'icon',
        'sort_order',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
