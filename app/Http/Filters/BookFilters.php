<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookFilters
{
    protected array $filters = [
        'title'     => 'filterTitle',
        'ids'       => 'filterIds',
        'author'    => 'filterAuthor',
        'languages' => 'filterLanguages',
        'mime'      => 'filterMime',
        'topic'     => 'filterTopic',
        'search'    => 'filterSearch',
    ];

    public function apply(Builder $query, Request $request): Builder
    {
        foreach ($this->filters as $key => $method) {
            if ($request->filled($key)) {
                $this->$method($query, $request->input($key));
            }
        }

        return $query;
    }

    public function filterTitle(Builder $query, string $value): void
    {
        $titles = explode(',', $value);
        $query->where(function ($q) use ($titles) {
            foreach ($titles as $title) {
                $q->orWhere('title', $this->likeOperator(), '%' . trim($title) . '%');
            }
        });
    }

    public function filterIds(Builder $query, string $value): void
    {
        $ids = array_map('intval', explode(',', $value));
        $query->whereIn('gutenberg_id', $ids);
    }

    public function filterAuthor(Builder $query, string $value): void
    {
        $authors = explode(',', $value);
        $query->whereHas('authors', function ($q) use ($authors) {
            $q->where(function ($q2) use ($authors) {
                foreach ($authors as $author) {
                    $q2->orWhere('name', $this->likeOperator(), '%' . trim($author) . '%');
                }
            });
        });
    }

    public function filterLanguages(Builder $query, string $value): void
    {
        $languages = explode(',', $value);
        $query->whereHas('languages', fn ($q) => $q->whereIn('code', $languages));
    }

    public function filterMime(Builder $query, string $value): void
    {
        $mimes = explode(',', $value);

        $query->whereHas('formats', function ($q) use ($mimes) {
            $q->where(function ($q2) use ($mimes) {
                foreach ($mimes as $mime) {
                    $q2->orWhere('mime_type', $this->likeOperator(), trim($mime) . '/%');
                }
            });
        });
    }

    public function filterTopic(Builder $query, string $value): void
    {
        $topics = explode(',', $value);
        $query->where(function ($q) use ($topics) {
            foreach ($topics as $topic) {
                $q->orWhereHas('subjects', fn ($s) => $s->where('name', $this->likeOperator(), "%$topic%"))
                    ->orWhereHas('bookshelves', fn ($b) => $b->where('name', $this->likeOperator(), "%$topic%"));
            }
        });
    }

    public function filterSearch(Builder $query, string $value): void
    {
        $terms = explode(',', $value);

        $query->where(function ($q) use ($terms) {
            foreach ($terms as $term) {
                $term = trim($term);

                $q->orWhere(function ($q2) use ($term) {
                    $q2->where('title', $this->likeOperator(), "%$term%")
                        ->orWhereHas('authors', function ($a) use ($term) {
                            $a->where('name', $this->likeOperator(), "%$term%");
                        });
                });
            }
        });
    }

    private function likeOperator(): string
    {
        return config('database.default') === 'pgsql' ? 'ILIKE' : 'LIKE';
    }
}
