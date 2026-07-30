<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title ?: '',
            'subtitle' => $this->subtitle ?: '',
            'description' => $this->description ?: '',
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
        ];
    }
}
