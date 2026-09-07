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
        'slug',
        'image',
        'video',
        'address',
        'phone',
        'latitude',
        'longitude',
        'maps_link',
        'tuntunan_name',
        'tuntunan_photo',
        'sort_order',
        'status'
    ];

    public function photos()
    {
        return $this->hasMany(LocationPhoto::class)
            ->orderBy('sort_order');
    }

    public function hours()
    {
        return $this->hasMany(LocationHour::class)
            ->orderBy('day');
    }

    public function activities()
    {
        return $this->hasMany(LocationActivity::class)
            ->orderBy('sort_order');
    }
}
