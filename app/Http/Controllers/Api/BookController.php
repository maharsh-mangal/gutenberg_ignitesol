<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\BookFilters;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request, BookFilters $filters)
    {
        $books = Book::with(['authors', 'languages', 'subjects', 'bookshelves', 'formats'])
            ->filter($filters)
            ->orderByDesc('download_count')
            ->paginate(25);

        return [
            'count'     => $books->count(),
            'next'      => $books->nextPageUrl(),
            'previous'  => $books->previousPageUrl(),
            'results'   => BooksResource::collection($books),
        ];
    }
}
