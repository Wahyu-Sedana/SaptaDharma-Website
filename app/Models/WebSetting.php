<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    /** @use HasFactory<\Database\Factories\WebSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'address',
        'phone',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'google_maps',
        'copyright'
    ];
}
