<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class HistoryHighlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'image' => $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png'),
            'title' => $this->title ?: '-',
            'excerpt' => Str::limit(strip_tags((string) $this->description), 140),
        ];
    }
}
