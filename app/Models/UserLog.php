<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserLog
 *
 * @property int $id
 * @property int $uid
 * @property string|null $ip
 * @property string|null $operate
 * @property string|null $address
 * @property string|null $src
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereOperate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserLog extends Model
{
    protected $table = 'user_log';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'ip', 'operate', 'address', 'src', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
