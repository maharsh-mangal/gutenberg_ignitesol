<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BookResponse",
    properties: [
        new OA\Property(property: "count", type: "integer"),
        new OA\Property(property: "next", type: "string", nullable: true),
        new OA\Property(property: "previous", type: "string", nullable: true),
        new OA\Property(
            property: "results",
            type: "array",
            items: new OA\Items(ref: "#/components/schemas/Book")
        )
    ],
    type: "object"
)]
class BookResponse {}
