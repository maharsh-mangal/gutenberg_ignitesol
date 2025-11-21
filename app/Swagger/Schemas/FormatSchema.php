<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Format",
 *     type="object",
 *     description="Available format for a book with URL",
 *     required={"mime_type", "url"},
 *
 *     @OA\Property(property="id", type="integer", example=45),
 *     @OA\Property(property="mime_type", type="string", example="image/jpeg"),
 *     @OA\Property(property="url", type="string", example="https://www.gutenberg.org/cache/epub/74/pg74.cover.medium.jpg")
 * )
 */
class FormatSchema {}
