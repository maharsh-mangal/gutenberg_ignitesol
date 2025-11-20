<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $mime_type
 * @property string $url
 * @property int $book_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Format whereUrl($value)
 *
 * @mixin \Eloquent
 */
class Format extends Model
{
    //
}
