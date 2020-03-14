<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $aid
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property-read \App\Models\PostItem $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostCollect extends Model
{
    protected $table = 'post_collect';
    protected $primaryKey = 'id';
    protected $dateFormat = 'U';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = ['aid','uid'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }
}
