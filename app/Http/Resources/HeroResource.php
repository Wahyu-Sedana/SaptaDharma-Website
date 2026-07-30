<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?: 'Sapta Darma',
            'subtitle' => $this->subtitle ?: '',
            'image' => $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png'),
            'video' => $this->video ? asset('storage/' . $this->video) : null,
        ];
    }
}
