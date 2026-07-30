<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HistoryTimeline extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryTimelineFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'year',
        'title',
        'description',
        'icon',
        'sort_order',
        'status'
    ];
}
