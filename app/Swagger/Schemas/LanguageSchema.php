<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Language",
 *     type="object",
 *     required={"code"},
 *     @OA\Property(property="id", type="integer", example=3),
 *     @OA\Property(property="code", type="string", example="en"),
 *     @OA\Property(property="name", type="string", example="English")
 * )
 */
class LanguageSchema {}
