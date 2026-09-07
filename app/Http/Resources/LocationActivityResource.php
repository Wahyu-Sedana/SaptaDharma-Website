<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo ? asset('storage/' . $this->photo) : asset('images/no-image.png'),
            'title' => $this->title ?: '-',
            'description' => $this->description ?: '',
        ];
    }
}
