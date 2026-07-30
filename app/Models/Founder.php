<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Founder extends Model
{
    /** @use HasFactory<\Database\Factories\FounderFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'position', 'description'];

    protected $fillable = [
        'name',
        'position',
        'image',
        'description',
        'sort_order',
        'status'
    ];
}
