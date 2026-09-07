<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name ?: '-',
            'image' => $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png'),
            'video' => $this->video ? asset('storage/' . $this->video) : null,
            'address' => $this->address ?: '',
            'phone' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'maps_link' => $this->maps_link,
            'tuntunan_name' => $this->tuntunan_name,
            'tuntunan_photo' => $this->tuntunan_photo ? asset('storage/' . $this->tuntunan_photo) : null,
            'is_open' => $this->isOpenNow(),
            'photos' => LocationPhotoResource::collection($this->whenLoaded('photos')),
            'hours' => LocationHourResource::collection($this->whenLoaded('hours')),
            'activities' => LocationActivityResource::collection($this->whenLoaded('activities')),
        ];
    }

    private function isOpenNow(): bool
    {
        $today = $this->hours->firstWhere('day', Carbon::now()->dayOfWeek);

        if (! $today || $today->is_closed || ! $today->open_time || ! $today->close_time) {
            return false;
        }

        $now = Carbon::now();

        return $now->between(
            Carbon::parse($today->open_time),
            Carbon::parse($today->close_time),
        );
    }
}
