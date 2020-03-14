<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostComment
 *
 * @property int $cid
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
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property-read \App\Models\PostItem $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereReplyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereReplyUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUsername($value)
 * @mixin \Eloquent
 */
class PostComment extends Model
{
    protected $table = 'post_comment';
    protected $primaryKey = 'cid';
    protected $guarded = [];
    protected $dateFormat = 'U';
    protected $casts = [
        'created_at'=>'datetime:Y-m-d H:i:s',
        'updated_at'=>'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'aid','uid','username','reply_uid','reply_name','message',
        'province','city','street','likes','state','created_at','updated_at'
    ];

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
