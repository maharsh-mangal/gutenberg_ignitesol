<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['authors', 'languages', 'subjects', 'bookshelves', 'formats'])
            ->paginate(20);

        return response()->json([
            'count' => $books->total(),
            'next' => $books->nextPageUrl(),
            'previous' => $books->previousPageUrl(),
            'results' => $books->items(),
        ]);
    }
}
