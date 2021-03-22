<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostTag
 *
 * @property int $tag_id
 * @property string $tag_name
 * @property int $tag_count
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagName($value)
 * @mixin \Eloquent
 */
class PostTag extends Model
{
    protected $table = 'post_tag';
    protected $primaryKey = 'tag_id';

    public $timestamps = false;
}
