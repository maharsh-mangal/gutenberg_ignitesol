<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $gutenberg_id
 * @property int|null $download_count
 * @property string $media_type
 * @property string|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Author> $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bookshelf> $bookshelves
 * @property-read int|null $bookshelves_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Format> $formats
 * @property-read int|null $formats_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Language> $languages
 * @property-read int|null $languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereDownloadCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereGutenbergId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereMediaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    protected $guarded = [];
    protected $table = 'books';

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

    public function formats()
    {
        return $this->hasMany(Format::class);
    }
}
