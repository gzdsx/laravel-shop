<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserConnect
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property string|null $appid
 * @property string|null $platform 平台
 * @property string|null $unionid
 * @property string|null $openid 开放ID
 * @property string|null $nickname 昵称
 * @property int $gender 性别
 * @property string|null $city 城市
 * @property string|null $province 省，州
 * @property string|null $country 国籍
 * @property string|null $avatar 头像地址
 * @property \Illuminate\Support\Carbon|null $created_at 登录时间
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect miniProgram()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect officialAccount()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect wechatApp()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserConnect extends Model
{
    protected $table = 'user_connect';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'appid', 'platform', 'unionid', 'openid', 'nickname', 'gender',
        'city', 'province', 'country', 'avatar', 'created_at', 'updated_at'
    ];

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
    public function scopeOfficialAccount(Builder $builder)
    {
        return $builder->where('platform', 'officialaccount');
    }

    public function scopeMiniProgram(Builder $builder)
    {
        return $builder->where('platform', 'miniprogram');
    }

    public function scopeWechatApp(Builder $builder)
    {
        return $builder->where('platform', 'wechatapp');
    }
}
