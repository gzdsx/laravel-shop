<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\JPush
 *
 * @property int $id
 * @property int|null $uid
 * @property string|null $appid
 * @property string|null $ios
 * @property string|null $android
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush android()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush ios()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereAndroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereIos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereUid($value)
 * @mixin \Eloquent
 */
class JPush extends Model
{
    protected $table = 'jpush';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'appid', 'platform', 'registrationid'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIos(Builder $builder)
    {
        return $builder->where('platform', 'ios');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeAndroid(Builder $builder)
    {
        return $builder->where('platform', 'android');
    }
}
