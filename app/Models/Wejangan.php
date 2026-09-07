<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Wejangan extends Model
{
    use HasTranslations;

    public $translatable = ['content'];

    protected $fillable = [
        'content',
        'sort_order',
        'status',
    ];
}
