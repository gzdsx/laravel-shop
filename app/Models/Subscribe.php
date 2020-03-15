<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Subscribe
 *
 * @property int $id
 * @property int $uid
 * @property int $subscribe_uid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $subscribeUser
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereSubscribeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscribe extends Model
{
    protected $table = 'subscribe';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'subscribe_uid', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subscribeUser()
    {
        return $this->hasOne(User::class, 'uid', 'subscribe_uid');
    }
}
