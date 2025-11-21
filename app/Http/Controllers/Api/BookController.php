<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\BookFilters;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Get filtered books",
     *     tags={"Books"},
     *     parameters={
     *       @OA\Parameter(ref="#/components/parameters/FilterTitle"),
     *       @OA\Parameter(ref="#/components/parameters/FilterIds"),
     *       @OA\Parameter(ref="#/components/parameters/FilterAuthor"),
     *       @OA\Parameter(ref="#/components/parameters/FilterLanguages"),
     *       @OA\Parameter(ref="#/components/parameters/FilterMime"),
     *       @OA\Parameter(ref="#/components/parameters/FilterTopic"),
     *       @OA\Parameter(ref="#/components/parameters/FilterSearch"),
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Books retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BookResponse")
     *     )
     * )
     */
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
