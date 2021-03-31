<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


/**
 * App\Models\Ad
 *
 * @property int $id ID
 * @property int $uid
 * @property string|null $title 标题
 * @property string $type
 * @property array|null $data
 * @property int $clicks
 * @property int $available 是否可用
 * @property string|null $begin_at
 * @property string|null $end_at
 * @property-read array|string|null $state_des
 * @property-read mixed|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUid($value)
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

    public $timestamps = false;

    /**
     * @return mixed|null
     */
    public function getTypeDesAttribute()
    {
        return trans('ad.ad_types.' . $this->type);
    }

    /**
     * @return array|string|null
     */
    public function getStateDesAttribute()
    {
        return trans('ad.ad_states.' . $this->available);
    }
}
