<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderRefund
 *
 * @property int $refund_id
 * @property int $order_id 订单ID
 * @property string|null $refund_no 退款单号
 * @property int $refund_type 退货类型,1=仅退款,2=退货退款
 * @property int $refund_state 处理状态
 * @property string|null $refund_reason 退货原因
 * @property string|null $refund_desc 退款说明
 * @property float $refund_amount 退款金额
 * @property mixed $created_at 创建时间
 * @property mixed $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\RefundShipping $shipping
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Refund extends Model
{
    protected $table = 'refund';
    protected $primaryKey = 'refund_id';
    protected $dateFormat = 'U';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'order_id', 'refund_no', 'refund_type', 'refund_state', 'refund_reason',
        'refund_desc', 'refund_amount', 'created_at', 'updated_at'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (Refund $orderRefund) {
            if (!$orderRefund->refund_no) $orderRefund->refund_no = createReundNo();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(RefundImage::class, 'refund_id', 'refund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipping()
    {
        return $this->hasOne(RefundShipping::class, 'refund_id', 'refund_id');
    }
}
