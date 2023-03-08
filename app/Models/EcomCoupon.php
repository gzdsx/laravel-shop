<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomCoupon
 *
 * @property int $id 主键
 * @property string|null $title 名称
 * @property int $type 类别
 * @property string $value 面值
 * @property string $min_amount 最小使用金额
 * @property int $per_limit 每人限领
 * @property \Illuminate\Support\Carbon|null $start_at 生效时间
 * @property \Illuminate\Support\Carbon|null $end_at 失效时间
 * @property int $used_count 已使用量
 * @property int $shop_id 关联店铺
 * @property int $state 是否可用
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read mixed $description
 * @property-read mixed $state_des
 * @property-read mixed $validity_range
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon wherePerLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereUsedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCoupon whereValue($value)
 * @mixin \Eloquent
 */
class EcomCoupon extends Model
{
    //use HasFactory;
    use HasDates;

    // 用常量的方式定义支持的优惠券类型
    const TYPE_FIXED = 1;
    const TYPE_PERCENT = 2;

    protected $table = 'ecom_coupon';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'type', 'value', 'min_amount', 'per_limit',
        'start_at', 'end_at', 'state', 'used_count'
    ];
    protected $dates = ['start_at', 'end_at'];
    protected $casts = [
        'start_at' => 'datetime:Y-m-d H:i',
        'end_at' => 'datetime:Y-m-d H:i',
    ];
    protected $appends = ['description', 'validity_range', 'state_des'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }

    public function getDescriptionAttribute()
    {
        $str = '';

        if ($this->min_amount > 0) {
            $str = '满' . str_replace('.00', '', $this->min_amount);
        }
        if ($this->type === self::TYPE_PERCENT) {
            return $str . '优惠' . str_replace('.00', '', $this->value) . '%';
        }

        return $str . '减' . str_replace('.00', '', $this->value);
    }

    public function getValidityRangeAttribute()
    {
        $start_at = $this->start_at ? $this->start_at->format('Y-m-d H:i') : null;
        $end_at = $this->end_at ? $this->end_at->format('Y-m-d H:i') : null;
        if ($this->start_at && $this->end_at) {
            return $start_at . '-' . $end_at;
        }

        if ($this->start_at) {
            return $start_at . '起可用';
        }

        if ($this->end_at) {
            return '有效期至' . $end_at;
        }

        return '不限';
    }

    public function getStateDesAttribute()
    {
        return $this->state ? '可用' : '已失效';
    }
}
