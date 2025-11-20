<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bookshelf whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bookshelf extends Model
{
    //
}
