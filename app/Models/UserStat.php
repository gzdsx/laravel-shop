<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserStat
 *
 * @property int $uid
 * @property int $posts
 * @property int $comments
 * @property int $albums
 * @property int $photos
 * @property int $follower
 * @property int $following
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereAlbums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereUid($value)
 * @mixin \Eloquent
 */
class UserStat extends Model
{
    protected $table = 'user_stat';
    protected $primaryKey = 'uid';
    protected $fillable = ['uid', 'posts', 'comments', 'albums', 'photos', 'follower', 'following'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
