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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereAlbums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereUid($value)
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
