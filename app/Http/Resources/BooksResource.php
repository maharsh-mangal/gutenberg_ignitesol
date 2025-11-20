<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Book */
class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param Request $request
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'gutenberg_id' => $this->gutenberg_id,
            'title' => $this->title,
            'download_count' => $this->download_count,

            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'languages' => LanguageResource::collection($this->whenLoaded('languages')),
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
            'bookshelves' => BookshelfResource::collection($this->whenLoaded('bookshelves')),
            'formats' => FormatResource::collection($this->whenLoaded('formats')),
        ];
    }
}
