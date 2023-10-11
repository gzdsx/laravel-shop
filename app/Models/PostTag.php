<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostTag
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @mixin \Eloquent
 */
class PostTag extends Model
{
    protected $table = 'post_tag';
    protected $primaryKey = 'tag_id';

    public $timestamps = false;
}
