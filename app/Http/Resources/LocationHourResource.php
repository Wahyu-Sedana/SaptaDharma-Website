<?php

namespace App\Http\Resources;

use App\Models\LocationHour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationHourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'day' => $this->day,
            'day_label' => LocationHour::DAYS[$this->day] ?? '-',
            'is_closed' => (bool) $this->is_closed,
            'open_time' => $this->open_time ? substr($this->open_time, 0, 5) : null,
            'close_time' => $this->close_time ? substr($this->close_time, 0, 5) : null,
        ];
    }
}
