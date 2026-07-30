<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\HeroResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\SectionResource;
use App\Models\Article;
use App\Models\Book;
use App\Models\Hero;
use App\Models\Location;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $page = Page::where('slug', 'home')->firstOrFail();

        $hero = Hero::where('page_id', $page->id)
            ->where('status', 'publish')
            ->latest()
            ->first();

        $sections = Section::where('page_id', $page->id)
            ->where('status', 'publish')
            ->get()
            ->keyBy('slug');

        $featuredArticle = Article::with('category')
            ->where('status', 'publish')
            ->latest('published_at')
            ->first();

        $latestArticles = Article::with('category')
            ->where('status', 'publish')
            ->latest('published_at')
            ->skip(1)
            ->take(3)
            ->get();

        $featuredBook = Book::with('category')
            ->where('status', 'publish')
            ->latest()
            ->first();

        $latestBooks = Book::with('category')
            ->where('status', 'publish')
            ->latest()
            ->take(4)
            ->get();

        $locations = Location::where('status', 'publish')
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'about' => $this->section($sections, 'home-about'),
                'latest_articles' => $this->section($sections, 'home-latest-articles'),
                'latest_books' => $this->section($sections, 'home-latest-books'),
                'locations' => $this->section($sections, 'home-locations'),
            ],
            'featured_article' => $featuredArticle ? new ArticleResource($featuredArticle) : null,
            'latest_articles' => ArticleResource::collection($latestArticles),
            'featured_book' => $featuredBook ? new BookResource($featuredBook) : null,
            'latest_books' => BookResource::collection($latestBooks),
            'locations' => LocationResource::collection($locations),
        ]);
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
