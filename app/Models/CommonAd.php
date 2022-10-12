<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CommonAd
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
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommonAd extends Model
{
    protected $table = 'common_ad';
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
