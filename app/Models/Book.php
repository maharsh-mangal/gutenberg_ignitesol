<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'book_language');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'book_subject');
    }

    public function bookshelves(): BelongsToMany
    {
        return $this->belongsToMany(Bookshelf::class, 'book_bookshelf');
    }

    public function formats(): HasMany
    {
        return $this->hasMany(Format::class);
    }
}
