<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Author",
 *     type="object",
 *     title="Author",
 *     required={"name"},
 *     @OA\Property(property="id", type="integer", example=12),
 *     @OA\Property(property="name", type="string", example="Charles Dickens"),
 *     @OA\Property(property="birth_year", type="integer", nullable=true, example=1812),
 *     @OA\Property(property="death_year", type="integer", nullable=true, example=1870)
 * )
 */
class AuthorSchema {}
