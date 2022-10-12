<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CommonJPush
 *
 * @property int $id
 * @property int|null $uid
 * @property string|null $appid
 * @property string|null $ios
 * @property string|null $android
 * @property-read \App\Models\User|null $user
 * @method static Builder|CommonJPush android()
 * @method static Builder|CommonJPush ios()
 * @method static Builder|CommonJPush newModelQuery()
 * @method static Builder|CommonJPush newQuery()
 * @method static Builder|CommonJPush query()
 * @method static Builder|CommonJPush whereAndroid($value)
 * @method static Builder|CommonJPush whereAppid($value)
 * @method static Builder|CommonJPush whereId($value)
 * @method static Builder|CommonJPush whereIos($value)
 * @method static Builder|CommonJPush whereUid($value)
 * @mixin \Eloquent
 */
class CommonJPush extends Model
{
    protected $table = 'common_jpush';
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
