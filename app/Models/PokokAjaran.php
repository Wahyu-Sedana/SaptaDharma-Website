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
        'slug',
        'is_featured',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function (self $pokokAjaran) {
            if ($pokokAjaran->is_featured) {
                static::where('id', '!=', $pokokAjaran->id)
                    ->where('is_featured', true)
                    ->update(['is_featured' => false]);
            }
        });
    }

    public function items()
    {
        return $this->hasMany(PokokAjaranItem::class)
            ->orderBy('sort_order');
    }
}
