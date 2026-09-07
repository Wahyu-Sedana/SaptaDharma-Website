<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LocationActivity extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'location_id',
        'photo',
        'title',
        'description',
        'sort_order',
        'status',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
