<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostTag
 *
 * @property int $tag_id
 * @property string $tag_name
 * @property int $tag_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagName($value)
 * @mixin \Eloquent
 */
class PostTag extends Model
{
    protected $table = 'post_tag';
    protected $primaryKey = 'tag_id';
    protected $guarded = [];

    public $timestamps = false;
}
