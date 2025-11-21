<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Bookshelf",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=4),
 *     @OA\Property(property="name", type="string", example="Adventure"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class BookshelfSchema {}
