<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FounderResource;
use App\Http\Resources\HeroResource;
use App\Http\Resources\HistoryTimelineResource;
use App\Http\Resources\SectionResource;
use App\Models\Founder;
use App\Models\Hero;
use App\Models\HistoryTimeline;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class HistoryController extends Controller
{
    public function index(): JsonResponse
    {
        $page = Page::where('slug', 'history')->firstOrFail();

        $hero = Hero::where('page_id', $page->id)
            ->where('status', 'publish')
            ->latest()
            ->first();

        $sections = Section::where('page_id', $page->id)
            ->where('status', 'publish')
            ->get()
            ->keyBy('slug');

        $timelines = HistoryTimeline::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        $founders = Founder::where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'about' => $this->section($sections, 'history-about'),
                'timeline' => $this->section($sections, 'history-timeline'),
                'founders' => $this->section($sections, 'history-founder'),
            ],
            'timelines' => HistoryTimelineResource::collection($timelines),
            'founders' => FounderResource::collection($founders),
        ]);
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
