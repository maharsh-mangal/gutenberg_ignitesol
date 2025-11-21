<?php

namespace App\Swagger\Parameters;

use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *     parameter="FilterTitle",
 *     name="title",
 *     in="query",
 *     description="Search by book title (min: 3 characters). Supports comma-separated multiple keywords.",
 *     @OA\Schema(type="string", example="war,peace,dawn")
 * )
 *
 * @OA\Parameter(
 *     parameter="FilterIds",
 *     name="ids",
 *     in="query",
 *     description="Exact Gutenberg IDs — comma separated.",
 *     @OA\Schema(type="string", example="11,25,98")
 * )
 *
 * @OA\Parameter(
 *     parameter="FilterAuthor",
 *     name="author",
 *     in="query",
 *     description="Search by author names — comma separated.",
 *     @OA\Schema(type="string", example="dickens,tolstoy")
 * )
 *
 * @OA\Parameter(
 *     parameter="FilterLanguages",
 *     name="languages",
 *     in="query",
 *     description="Filter by language codes (ISO-2 format).",
 *     @OA\Schema(type="string", example="en,fr,es")
 * )
 *
 * @OA\Parameter(
 *     parameter="FilterMime",
 *     name="mime",
 *     in="query",
 *     description="Filter by MIME type — partial match allowed.",
 *     @OA\Schema(type="string", example="image,text%2Fhtml")
 * )
 *
 * @OA\Parameter(
 *     parameter="FilterTopic",
 *     name="topic",
 *     in="query",
 *     description="Search book subjects OR bookshelves.",
 *     @OA\Schema(type="string", example="children,romance")
 * )
 *
 * @OA\Parameter(
 *     parameter="FilterSearch",
 *     name="search",
 *     in="query",
 *     description="Smart search — matches title OR author.",
 *     @OA\Schema(type="string", example="great expectations")
 * )
 */
class BookFilters {}
