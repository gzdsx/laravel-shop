<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserEducation
 *
 * @property int $id 主键
 * @property int|null $uid 用户ID
 * @property string|null $school_name 学校名称
 * @property string|null $degree_name 学位名称
 * @property string|null $field_of_study_name 专业名称
 * @property \Illuminate\Support\Carbon|null $start_at 入学时间
 * @property \Illuminate\Support\Carbon|null $end_at 毕业时间
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereDegreeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereFieldOfStudyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserEducation extends Model
{
    use HasDates;

    protected $table = 'user_education';
    protected $fillable = ['school_name', 'degree_name', 'field_of_study_name', 'start_at', 'end_at', 'description'];
    protected $dates = ['start_at', 'end_at'];
    protected $casts = [
        'start_at' => 'datetime:Y-m',
        'end_at' => 'datetime:Y-m'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
