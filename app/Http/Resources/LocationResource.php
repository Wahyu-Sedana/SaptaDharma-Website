<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?: '-',
            'image' => $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png'),
            'address' => $this->address ?: '',
            'phone' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'maps_link' => $this->maps_link,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'is_open' => $this->isOpenNow(),
        ];
    }

    private function isOpenNow(): bool
    {
        if (! $this->open_time || ! $this->close_time) {
            return false;
        }

        $now = Carbon::now();
        $open = Carbon::parse($this->open_time);
        $close = Carbon::parse($this->close_time);

        return $now->between($open, $close);
    }
}
