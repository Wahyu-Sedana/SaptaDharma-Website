<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?: '(Tanpa judul)',
            'slug' => $this->slug,
            'image' => $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png'),
            'excerpt' => Str::limit(strip_tags($this->content ?: ''), 150),
            'author' => $this->author ?: '-',
            'views' => $this->views ?? 0,
            'category' => $this->whenLoaded('category', fn () => [
                'name' => $this->category?->name ?: 'Umum',
                'slug' => $this->category?->slug,
            ]),
            'published_at' => optional($this->published_at)->toIso8601String(),
        ];
    }
}
