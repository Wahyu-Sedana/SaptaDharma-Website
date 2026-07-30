<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\HeroResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\SectionResource;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Location;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function index(): JsonResponse
    {
        $page = Page::where('slug', 'locations')->firstOrFail();

        $hero = Hero::where('page_id', $page->id)
            ->where('status', 'publish')
            ->latest()
            ->first();

        $sections = Section::where('page_id', $page->id)
            ->where('status', 'publish')
            ->get()
            ->keyBy('slug');

        $locations = Location::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        $galleries = Gallery::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'locations' => $this->section($sections, 'location-list'),
                'gallery' => $this->section($sections, 'location-gallery'),
            ],
            'locations' => LocationResource::collection($locations),
            'galleries' => GalleryResource::collection($galleries),
        ]);
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
