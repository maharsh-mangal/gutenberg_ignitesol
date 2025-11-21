<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Book",
    properties: [
        new OA\Property(property: "id", type: "integer"),
        new OA\Property(property: "gutenberg_id", type: "integer"),
        new OA\Property(property: "title", type: "string"),
        new OA\Property(property: "download_count", type: "integer"),

        new OA\Property(
            property: "authors",
            type: "array",
            items: new OA\Items(properties: [
                new OA\Property(property: "name", type: "string")
            ])
        ),

        new OA\Property(
            property: "languages",
            type: "array",
            items: new OA\Items(properties: [
                new OA\Property(property: "code", type: "string")
            ])
        ),

        new OA\Property(
            property: "formats",
            description: "Book formats & available MIME types",
            type: "array",
            items: new OA\Items(properties: [
                new OA\Property(property: "mime_type", type: "string"),
                new OA\Property(property: "url", type: "string")
            ])
        ),
    ],
    type: "object"
)]
class BookSchema {}
