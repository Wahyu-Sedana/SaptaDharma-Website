<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PokokAjaranItem extends Model
{
    /** @use HasFactory<\Database\Factories\PokokAjaranItemFactory> */
    use HasFactory;
    use HasTranslations;

    protected $table = 'pokok_ajaran_items';

    public $translatable = ['title', 'description', 'quote'];

    protected $fillable = [
        'pokok_ajaran_id',
        'title',
        'image',
        'description',
        'quote',
        'sort_order',
        'status'
    ];

    public function pokokAjaran()
    {
        return $this->belongsTo(PokokAjaran::class);
    }
}
