<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VideoComment
 *
 * @property int $id 主键
 * @property int $vid 视频ID
 * @property int $uid 用户ID
 * @property string|null $message 评论内容
 * @property int $likes 获赞
 * @property int $state 审核状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Video|null $video
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideoComment whereVid($value)
 * @mixin \Eloquent
 */
class VideoComment extends Model
{
    use HasDates;

    protected $table = 'video_comment';
    protected $primaryKey = 'id';
    protected $fillable = ['vid', 'uid', 'message', 'state', 'likes'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function (VideoComment $comment) {
            $comment->video()->increment('total_comments');
        });

        static::deleting(function (VideoComment $comment) {
            $comment->video()->decrement('total_comments');
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