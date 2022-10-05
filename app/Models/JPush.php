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
 * @method static Builder|JPush android()
 * @method static Builder|JPush ios()
 * @method static Builder|JPush newModelQuery()
 * @method static Builder|JPush newQuery()
 * @method static Builder|JPush query()
 * @method static Builder|JPush whereAndroid($value)
 * @method static Builder|JPush whereAppid($value)
 * @method static Builder|JPush whereId($value)
 * @method static Builder|JPush whereIos($value)
 * @method static Builder|JPush whereUid($value)
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
