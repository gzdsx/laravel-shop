<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserInfo
 *
 * @property int $uid
 * @property int $gender
 * @property string|null $birthday
 * @property int $blood
 * @property int $star
 * @property string|null $country
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $town
 * @property string|null $street
 * @property string|null $introduction
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'uid';
    protected $fillable = [
        'uid', 'gender', 'birthday', 'blood', 'star', 'country', 'province',
        'city', 'district', 'town', 'street', 'introduction', 'tags', 'created_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
