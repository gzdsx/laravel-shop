<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserInfo
 *
 * @property int $uid 用户ID
 * @property string|null $firstname 名
 * @property string|null $lastname 姓
 * @property int $gender 性别
 * @property \Illuminate\Support\Carbon|null $birthday 生日
 * @property int $age 年龄
 * @property float|null $height 身高
 * @property float|null $weight 体重
 * @property string|null $education 学历
 * @property int $blood 血型
 * @property int $star 星座
 * @property string|null $weixin 微信号
 * @property string|null $country 国籍
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $town 乡镇
 * @property string|null $street 街道
 * @property string|null $bio 个人简介
 * @property \Illuminate\Support\Carbon|null $start_work_at 参加工作时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed $fullname
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $gender_des
 * @property-read mixed $work_years
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStartWorkAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereWeixin($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasDates;

    protected $table = 'user_profile';
    protected $primaryKey = 'uid';
    protected $fillable = [
        'uid', 'firstname', 'lastname', 'gender', 'birthday', 'age', 'height', 'weight', 'education', 'blood',
        'star', 'weixin', 'country', 'province', 'city', 'district', 'town', 'street', 'bio', 'start_work_at'
    ];
    protected $dates = ['birthday', 'start_work_at'];
    protected $appends = ['fullname', 'gender_des', 'work_years'];
    protected $casts = [
        'birthday' => 'date:Y-m-d',
        'start_work_at' => 'date:Y-m'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    public function getFullnameAttribute()
    {
        return $this->lastname . $this->firstname;
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getGenderDesAttribute()
    {
        return trans('user.sex_items.' . $this->gender);
    }

    public function getWorkYearsAttribute()
    {
        return is_null($this->start_work_at) ? 0 : $this->start_work_at->diffInYears();
    }
}
