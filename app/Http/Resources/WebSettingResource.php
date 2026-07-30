<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'site_name' => $this->site_name ?: 'Sapta Darma',
            'logo' => $this->logo ? asset('storage/' . $this->logo) : null,
            'favicon' => $this->favicon ? asset('storage/' . $this->favicon) : null,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'google_maps' => $this->google_maps,
            'copyright' => $this->copyright ?: '© ' . date('Y') . ' Sapta Darma',
        ];
    }
}
