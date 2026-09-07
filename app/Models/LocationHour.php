<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationHour extends Model
{
    protected $fillable = [
        'location_id',
        'day',
        'is_closed',
        'open_time',
        'close_time',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
    ];

    public const DAYS = [
        0 => 'Minggu',
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
