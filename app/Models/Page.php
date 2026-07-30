<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function hero()
    {
        return $this->hasOne(Hero::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
