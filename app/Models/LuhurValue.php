<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LuhurValue extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [

        'title',
        'description',
        'icon',
        'sort_order',
        'status',

    ];
}
