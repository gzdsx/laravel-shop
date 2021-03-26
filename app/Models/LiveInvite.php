<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LiveInvite
 *
 * @property int $id
 * @property int|null $live_id
 * @property int|null $uid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereLiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveInvite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LiveInvite extends Model
{
    protected $table = 'live_invite';
    protected $primaryKey = 'id';
    protected $fillable = ['live_id', 'uid', 'code'];
    protected $appends = ['link'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

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
