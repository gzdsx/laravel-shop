<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostLog
 *
 * @property int $aid
 * @property int $uid
 * @property string|null $title
 * @property string|null $action_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostLog extends Model
{
    protected $table = 'post_log';
    protected $primaryKey = 'id';
    protected $fillable = ['aid', 'uid', 'title', 'action_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }
}
