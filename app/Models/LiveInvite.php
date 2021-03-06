<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LiveInvite
 *
 * @property int $id 主键
 * @property int|null $live_id 直播ID
 * @property int|null $uid 用户ID
 * @property string|null $code 邀请码
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $link
 * @property-read \App\Models\Live|null $live
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereLiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LiveInvite extends Model
{
    use HasDates;

    protected $table = 'live_invite';
    protected $primaryKey = 'id';
    protected $fillable = ['live_id', 'uid', 'code'];
    protected $appends = ['link'];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getLinkAttribute()
    {
        return url('h5/live/invite/' . $this->code);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    public function live()
    {
        return $this->belongsTo(Live::class, 'live_id', 'id');
    }
}
