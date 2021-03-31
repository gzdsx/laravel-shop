<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserInfo
 *
 * @property int $uid 用户ID
 * @property string|null $realname 真实姓名
 * @property int $gender 性别
 * @property string|null $birthday 生日
 * @property int $blood 血型
 * @property int $star 星座
 * @property string|null $country 国籍
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $town 乡镇
 * @property string|null $street 街道
 * @property string|null $bio 个人简介
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRealname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasDates;

    protected $table = 'user_profile';
    protected $primaryKey = 'uid';
    protected $fillable = [
        'uid', 'realname', 'gender', 'birthday', 'blood', 'star',
        'country', 'province', 'city', 'district', 'town', 'street', 'bio'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
