<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCategoryResource;
use App\Http\Resources\BookDetailResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\HeroResource;
use App\Http\Resources\SectionResource;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Hero;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = Page::where('slug', 'books')->firstOrFail();

        $hero = Hero::where('page_id', $page->id)
            ->where('status', 'publish')
            ->latest()
            ->first();

        $sections = Section::where('page_id', $page->id)
            ->where('status', 'publish')
            ->get()
            ->keyBy('slug');

        $categories = BookCategory::orderBy('name')->get();

        $books = Book::with('category')
            ->where('status', 'publish')
            ->when($request->query('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->query('category'));
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return response()->json([
            'hero' => $hero ? new HeroResource($hero) : null,
            'sections' => [
                'list' => $this->section($sections, 'book-list'),
            ],
            'categories' => BookCategoryResource::collection($categories),
            'books' => BookResource::collection($books),
            'meta' => [
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
                'total' => $books->total(),
            ],
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $book = Book::with('category')
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $book->increment('views');
        $book->refresh();

        $relatedBooks = Book::with('category')
            ->where('status', 'publish')
            ->where('id', '!=', $book->id)
            ->where('category_id', $book->category_id)
            ->latest('created_at')
            ->take(4)
            ->get();

        return response()->json([
            'book' => new BookDetailResource($book),
            'related_books' => BookResource::collection($relatedBooks),
        ]);
    }

    public function download(string $slug): StreamedResponse
    {
        $book = Book::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        abort_unless($book->pdf && Storage::disk('public')->exists($book->pdf), 404);

        $book->increment('downloads');

        return Storage::disk('public')->download($book->pdf, $book->title . '.pdf');
    }

    private function section($sections, string $slug): ?SectionResource
    {
        $section = $sections->get($slug);

        return $section ? new SectionResource($section) : null;
    }
}
