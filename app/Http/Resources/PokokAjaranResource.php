<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PokokAjaranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?: '-',
            'items' => PokokAjaranItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
