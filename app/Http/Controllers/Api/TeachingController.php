<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Http\Resources\LuhurValueResource;
use App\Http\Resources\PokokAjaranResource;
use App\Http\Resources\SectionResource;
use App\Models\Hero;
use App\Models\LuhurValue;
use App\Models\Page;
use App\Models\PokokAjaran;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class TeachingController extends Controller
{
    public function index(): JsonResponse
    {
        $page = Page::where('slug', 'teachings')->firstOrFail();

        $hero = Hero::where('page_id', $page->id)
            ->where('status', 'publish')
            ->latest()
            ->first();

        $sections = Section::where('page_id', $page->id)
            ->where('status', 'publish')
            ->get()
            ->keyBy('slug');

        $luhurValues = LuhurValue::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        $pokokAjarans = PokokAjaran::with('items')
            ->where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'values' => $this->section($sections, 'teaching-nilai-nilai-luhur'),
                'pokok_ajaran' => $this->section($sections, 'teaching-pokok-ajaran'),
            ],
            'luhur_values' => LuhurValueResource::collection($luhurValues),
            'pokok_ajarans' => PokokAjaranResource::collection($pokokAjarans),
        ]);
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
