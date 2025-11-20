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

        if ($request->filled('title')) {
            $query->where('title', $this->likeOperator(), "%{$request->title}%");
        }

        if ($request->filled('author')) {
            $query->whereHas('authors', function ($q) use ($request) {
                $q->where('name', $this->likeOperator(), "%{$request->author}%");
            });
        }

        if ($request->filled('language')) {
            $query->whereHas('languages', function ($q) use ($request) {
                $q->where('code', $this->likeOperator(), "%{$request->language}%");
            });
        }

        if ($request->filled('mime')) {
            $query->whereHas('formats', function ($q) use ($request) {
                $q->where('mime_type', $this->likeOperator(), "%{$request->mime}%");
            });
        }

        if ($request->filled('topic')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('subjects', function ($s) use ($request) {
                    $s->where('name', $this->likeOperator(), "%{$request->topic}%");
                })->orWhereHas('bookshelves', function ($b) use ($request) {
                    $b->where('name', $this->likeOperator(), "%{$request->topic}%");
                });
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
