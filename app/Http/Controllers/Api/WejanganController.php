<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\WejanganResource;
use App\Models\Hero;
use App\Models\Page;
use App\Models\Section;
use App\Models\Wejangan;
use Illuminate\Http\JsonResponse;

class WejanganController extends Controller
{
    public function index(): JsonResponse
    {
        $page = Page::where('slug', 'wejangan')->firstOrFail();

        $hero = Hero::where('page_id', $page->id)
            ->where('status', 'publish')
            ->latest()
            ->first();

        $sections = Section::where('page_id', $page->id)
            ->where('status', 'publish')
            ->get()
            ->keyBy('slug');

        $wejangans = Wejangan::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'list' => $this->section($sections, 'wejangan-list'),
            ],
            'wejangans' => WejanganResource::collection($wejangans),
        ]);
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
