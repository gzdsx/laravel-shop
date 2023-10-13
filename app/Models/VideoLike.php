<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VideoLike
 *
 * @property int $id 主键
 * @property int $vid 视频ID
 * @property int $uid 用户ID
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Video|null $video
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike query()
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoLike whereVid($value)
 * @mixin \Eloquent
 */
class VideoLike extends Model
{
    use HasDates;

    protected $table = 'video_like';
    protected $primaryKey = 'id';
    protected $fillable = ['vid', 'uid'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function (VideoLike $like) {
            if ($like->video) {
                $like->video->increment('like_count');
            }
        });

        static::deleting(function (VideoLike $like) {
            if ($like->video) {
                $like->video->decrement('like_count');
            }
        });
    }

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
    public function video()
    {
        return $this->belongsTo(Video::class, 'vid', 'vid');
    }
}
