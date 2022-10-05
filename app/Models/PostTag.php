<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostTag
 *
 * @property int $id
 * @property string $name
 * @property int $total
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTotal($value)
 * @mixin \Eloquent
 */
class PostTag extends Model
{
    protected $table = 'post_tag';
    protected $primaryKey = 'tag_id';

    public $timestamps = false;
}
