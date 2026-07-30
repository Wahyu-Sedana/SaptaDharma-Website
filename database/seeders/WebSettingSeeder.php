<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Sapta Darma',

                'logo' => 'logo.png',

                'favicon' => 'favicon.ico',

                'address' => 'Denpasar, Bali',

                'phone' => '08123456789',

                'email' => 'info@saptadarma.id',

                'facebook' => '',

                'instagram' => '',

                'youtube' => '',

                'copyright' => '© ' . date('Y') . ' Sapta Darma'
            ]
        );
    }
}
