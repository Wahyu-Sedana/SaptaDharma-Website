<?php

namespace Database\Factories;

use App\Models\WebSetting;
use Database\Seeders\Support\PlaceholderMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WebSetting>
 */
class WebSettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'site_name' => 'Sapta Darma',
            'logo' => PlaceholderMedia::image('settings', 'logo', 'Sapta Darma Logo', 400, 400),
            'favicon' => PlaceholderMedia::image('settings', 'favicon', 'SD', 64, 64),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => 'info@saptadarma.id',
            'facebook' => 'https://facebook.com/saptadarma',
            'instagram' => 'https://instagram.com/saptadarma',
            'youtube' => 'https://youtube.com/@saptadarma',
            'google_maps' => null,
            'copyright' => '© ' . date('Y') . ' Sapta Darma',
        ];
    }
}
