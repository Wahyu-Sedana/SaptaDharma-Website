<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FounderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?: '-',
            'position' => $this->position ?: '-',
            'image' => $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png'),
            'description' => $this->description ?: '',
        ];
    }
}
