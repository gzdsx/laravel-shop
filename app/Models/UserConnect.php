<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserConnect
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $appid APPID
 * @property string|null $platform 平台
 * @property string|null $unionid UnionID
 * @property string|null $openid 开放ID
 * @property string|null $nickname 昵称
 * @property int $gender 性别
 * @property string|null $city 城市
 * @property string|null $province 省，州
 * @property string|null $country 国籍
 * @property string|null $avatar 头像地址
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static Builder|UserConnect newModelQuery()
 * @method static Builder|UserConnect newQuery()
 * @method static Builder|UserConnect query()
 * @method static Builder|UserConnect whereAppid($value)
 * @method static Builder|UserConnect whereAvatar($value)
 * @method static Builder|UserConnect whereCity($value)
 * @method static Builder|UserConnect whereCountry($value)
 * @method static Builder|UserConnect whereCreatedAt($value)
 * @method static Builder|UserConnect whereGender($value)
 * @method static Builder|UserConnect whereId($value)
 * @method static Builder|UserConnect whereNickname($value)
 * @method static Builder|UserConnect whereOpenid($value)
 * @method static Builder|UserConnect wherePlatform($value)
 * @method static Builder|UserConnect whereProvince($value)
 * @method static Builder|UserConnect whereUid($value)
 * @method static Builder|UserConnect whereUnionid($value)
 * @method static Builder|UserConnect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserConnect extends Model
{
    use HasDates;

    protected $table = 'user_connect';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'appid', 'platform', 'unionid', 'openid', 'nickname', 'gender', 'city', 'province', 'country', 'avatar'
    ];

    /**
     * @param $openid
     * @return Builder|Model|object|UserConnect|null
     */
    public static function findByOpenid($openid)
    {
        return UserConnect::whereOpenid($openid)->first();
    }

    /**
     * @param $unionid
     * @return UserConnect|Builder|Model|object|UserConnect|null
     */
    public static function findByUnionid($unionid)
    {
        return UserConnect::whereUnionid($unionid)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
