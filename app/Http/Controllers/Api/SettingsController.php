<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebSettingResource;
use App\Http\Resources\WejanganResource;
use App\Models\Page;
use App\Models\WebSetting;
use App\Models\Wejangan;
use Illuminate\Http\JsonResponse;

class SettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $setting = WebSetting::first();
        $pages = Page::select('name', 'slug')->get();

        $wejangans = Wejangan::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'setting' => new WebSettingResource($setting ?? new WebSetting()),
            'pages' => $pages,
            'wejangans' => WejanganResource::collection($wejangans),
        ]);
    }
}
