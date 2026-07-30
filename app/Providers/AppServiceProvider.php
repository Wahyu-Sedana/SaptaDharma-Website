<?php

namespace App\Providers;

use App\Models\WebSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('web_settings')) {
            View::share('setting', WebSetting::first());
        }
    }
}
