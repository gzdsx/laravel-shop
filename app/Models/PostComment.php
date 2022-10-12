<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostComment
 *
 * @property int $id
 * @property int $aid
 * @property int $uid
 * @property string|null $username
 * @property int $reply_uid
 * @property string|null $reply_name
 * @property string|null $message
 * @property string|null $province
 * @property string|null $city
 * @property string|null $street
 * @property int $likes
 * @property int $state 审核状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostItem|null $post
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereReplyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereReplyUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUsername($value)
 * @mixin \Eloquent
 */
class PostComment extends Model
{
    use HasDates;

    protected $table = 'post_comment';
    protected $primaryKey = 'cid';
    protected $fillable = ['aid', 'uid', 'message', 'province', 'city', 'district', 'street', 'lng', 'lat', 'likes', 'state'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
