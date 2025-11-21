<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['authors', 'languages', 'subjects', 'bookshelves', 'formats']);

        // Title filter
        if ($request->filled('title')) {
            $titles = explode(',', $request->title);
            $query->where(function ($q) use ($titles) {
                foreach ($titles as $title) {
                    $q->orWhere('title', $this->likeOperator(), '%'.trim($title).'%');
                }
            });
        }

        //id filter
        if ($request->filled('ids')) {
            $ids = array_map('intval', explode(',', $request->ids));
            $query->whereIn('gutenberg_id', $ids);
        }

        // Author filter
        if ($request->filled('author')) {
            $authors = explode(',', $request->author);
            $query->whereHas('authors', function ($q) use ($authors) {
                $q->where(function ($q2) use ($authors) {
                    foreach ($authors as $author) {
                        $q2->orWhere('name', $this->likeOperator(), '%'.trim($author).'%');
                    }
                });
            });
        }

        // Language filter
        if ($request->filled('language')) {
            $languages = explode(',', $request->language);
            $query->whereHas('languages', function ($q) use ($languages) {
                $q->where(function ($q2) use ($languages) {
                    foreach ($languages as $lang) {
                        $q2->orWhere('code', $this->likeOperator(), '%'.trim($lang).'%');
                    }
                });
            });
        }

        // Mime filter
        if ($request->filled('mime')) {
            $mimes = explode(',', $request->mime);
            $query->whereHas('formats', function ($q) use ($mimes) {
                $q->where(function ($q2) use ($mimes) {
                    foreach ($mimes as $mime) {
                        $q2->orWhere('mime_type', $this->likeOperator(), '%'.trim($mime).'%');
                    }
                });
            });
        }

        // Topic filter (subject OR bookshelf)
        if ($request->filled('topic')) {
            $topics = explode(',', $request->topic);
            $query->where(function ($q) use ($topics) {
                foreach ($topics as $topic) {
                    $q->orWhereHas('subjects', fn ($s) => $s->where('name', $this->likeOperator(), '%'.trim($topic).'%')
                    )->orWhereHas('bookshelves', fn ($b) => $b->where('name', $this->likeOperator(), '%'.trim($topic).'%')
                    );
                }
            });
        }

        $books = $query->orderBy('download_count', 'desc')->paginate(20);

        return [
            'count' => $books->count(),
            'next' => $books->nextPageUrl(),
            'previous' => $books->previousPageUrl(),
            'results' => BooksResource::collection($books),
        ];
    }

    private function likeOperator(): string
    {
        return config('database.default') === 'pgsql' ? 'ILIKE' : 'LIKE';
    }
}
