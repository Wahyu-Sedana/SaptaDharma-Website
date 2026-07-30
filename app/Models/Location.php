<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'address'];

    protected $fillable = [
        'name',
        'image',
        'address',
        'phone',
        'latitude',
        'longitude',
        'maps_link',
        'open_time',
        'close_time',
        'sort_order',
        'status'
    ];
}
