<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserStat
 *
 * @property int $uid 用户ID
 * @property int $fans 粉丝数
 * @property int $follows 关注数
 * @property int $likes 获赞数
 * @property int $posts 文章数
 * @property int $videos 视频数
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereFans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereFollows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereVideos($value)
 * @mixin \Eloquent
 */
class UserStats extends Model
{
    protected $table = 'user_stats';
    protected $primaryKey = 'uid';
    protected $fillable = ['uid', 'fans', 'follows', 'likes', 'posts', 'videos'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
