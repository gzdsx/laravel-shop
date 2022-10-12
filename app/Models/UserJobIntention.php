<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserJobIntention
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $position_name 职位名称
 * @property string|null $work_place 工作地点
 * @property int $job_type 求职类型
 * @property-read mixed $job_type_name
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereJobType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereWorkPlace($value)
 * @mixin \Eloquent
 */
class UserJobIntention extends Model
{
    //use HasFactory;

    protected $table = 'user_job_intention';
    protected $fillable = ['uid', 'job_type', 'work_place', 'position_name'];
    protected $appends = ['job_type_name'];

    public $timestamps = false;

    public function getJobTypeNameAttribute()
    {
        return data_get(['不限', '全职', '兼职', '实习'], $this->job_type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
