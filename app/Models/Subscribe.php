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
 * @property-read \App\Models\User|null $subscribeUser
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereSubscribeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereUpdatedAt($value)
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
