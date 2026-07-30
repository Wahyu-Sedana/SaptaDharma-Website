<?php

use App\Models\WebSetting;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    $setting = WebSetting::first();

    return view('spa', [
        'siteName' => $setting?->site_name ?: 'Sapta Darma',
        'favicon' => $setting?->favicon ? asset('storage/' . $setting->favicon) : null,
    ]);
})->where('any', '^(?!admin|api|storage|build|images).*$')->name('spa');
