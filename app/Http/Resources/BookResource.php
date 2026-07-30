<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?: '(Tanpa judul)',
            'slug' => $this->slug,
            'author' => $this->author ?: '-',
            'cover' => $this->cover ? asset('storage/' . $this->cover) : asset('images/no-image.png'),
            'category' => $this->whenLoaded('category', fn () => [
                'name' => $this->category?->name ?: 'Umum',
                'slug' => $this->category?->slug,
            ]),
            'views' => $this->views ?? 0,
            'downloads' => $this->downloads ?? 0,
        ];
    }
}
