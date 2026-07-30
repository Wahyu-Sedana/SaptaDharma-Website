<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebSettingResource;
use App\Models\Page;
use App\Models\WebSetting;
use Illuminate\Http\JsonResponse;

class SettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $setting = WebSetting::first();
        $pages = Page::select('name', 'slug')->get();

        return response()->json([
            'setting' => new WebSettingResource($setting ?? new WebSetting()),
            'pages' => $pages,
        ]);
    }
}
