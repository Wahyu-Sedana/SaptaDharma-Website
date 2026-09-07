<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HistoryHighlight extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'slug',
        'image',
        'title',
        'description',
        'sort_order',
        'status',
    ];
}
