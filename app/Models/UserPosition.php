<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPosition
 *
 * @property int $id 主键
 * @property int $uid 关联用户
 * @property string|null $company_name 公司名称
 * @property string|null $position_name 职位名称
 * @property string|null $geo_location_name 工作地点
 * @property string|null $industry_name 行业名称
 * @property \Illuminate\Support\Carbon|null $start_at 入职时间
 * @property \Illuminate\Support\Carbon|null $end_at 离职时间
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed $years
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereGeoLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereIndustryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserPosition extends Model
{
    use HasDates;

    protected $table = 'user_position';
    protected $fillable = ['company_name', 'position_name', 'geo_location_name', 'industry_name', 'start_at', 'end_at', 'description'];
    protected $dates = ['start_at', 'end_at'];
    protected $casts = [
        'start_at' => 'datetime:Y-m',
        'end_at' => 'datetime:Y-m'
    ];
    protected $appends = ['years'];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    public function getYearsAttribute()
    {
        if (is_null($this->start_at)) {
            return null;
        }

        if (is_null($this->end_at)) {
            return $this->start_at->diffInYears();
        }

        return $this->start_at->diffInYears($this->end_at);
    }
}
