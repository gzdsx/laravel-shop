<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Ad
 *
 * @property int $id ID
 * @property int $uid 用户ID
 * @property string|null $title 标题
 * @property string $type 类型
 * @property array|null $data 内容
 * @property int $clicks 点击数
 * @property int $available 是否可用
 * @property \Illuminate\Support\Carbon|null $begin_at 生效日期
 * @property \Illuminate\Support\Carbon|null $end_at 失效日期
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read array|string|null $state_des
 * @property-read mixed|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ad extends Model
{
    protected $table = 'ad';
    protected $primaryKey = 'id';
    protected $casts = [
        'data' => 'array'
    ];
    protected $appends = [
        'type_des',
        'state_des'
    ];
    protected $fillable = [
        'uid', 'title', 'type', 'data'
    ];
    protected $dates = ['begin_at', 'end_at'];

    /**
     * @return mixed|null
     */
    public function getTypeDesAttribute()
    {
        return trans('ad.types.' . $this->type);
    }

    /**
     * @return array|string|null
     */
    public function getStateDesAttribute()
    {
        return trans('ad.states.' . $this->available);
    }
}
