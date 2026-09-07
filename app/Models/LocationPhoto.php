<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationPhoto extends Model
{
    protected $fillable = [
        'location_id',
        'photo',
        'caption',
        'sort_order',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
