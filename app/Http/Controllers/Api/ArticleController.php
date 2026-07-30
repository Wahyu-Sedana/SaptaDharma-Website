<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCategoryResource;
use App\Http\Resources\ArticleDetailResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\HeroResource;
use App\Http\Resources\SectionResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Hero;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = Page::where('slug', 'articles')->firstOrFail();

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

        $categories = ArticleCategory::orderBy('name')->get();

        $articles = Article::with('category')
            ->where('status', 'publish')
            ->when($request->query('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->query('category'));
                });
            }, function ($query) use ($featuredArticle) {
                if ($featuredArticle) {
                    $query->where('id', '!=', $featuredArticle->id);
                }
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'featured' => $this->section($sections, 'article-featured'),
                'list' => $this->section($sections, 'article-list'),
            ],
            'featured_article' => $featuredArticle ? new ArticleResource($featuredArticle) : null,
            'categories' => ArticleCategoryResource::collection($categories),
            'articles' => ArticleResource::collection($articles),
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'total' => $articles->total(),
            ],
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $article->increment('views');
        $article->refresh();

        $relatedArticles = Article::with('category')
            ->where('status', 'publish')
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return response()->json([
            'article' => new ArticleDetailResource($article),
            'related_articles' => ArticleResource::collection($relatedArticles),
        ]);
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
