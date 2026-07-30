<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PokokAjaran extends Model
{
    /** @use HasFactory<\Database\Factories\PokokAjaranFactory> */
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'sort_order',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(PokokAjaranItem::class)
            ->orderBy('sort_order');
    }
}
