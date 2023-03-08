<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderItem
 *
 * @property int $trade_id 主键
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property int $type 商品类型
 * @property string|null $title 商品名称
 * @property string $price 商品价格
 * @property int $quantity 商品数量
 * @property string $image 商品图片
 * @property int|null $sku_id 属性ID
 * @property string|null $sku_title 商品属性
 * @property int $is_gift 是否赠品
 * @property int $refund_state 退款状态
 * @property-read float|int $total_fee
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\Refund|null $refund
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereIsGift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereType($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    use HasImageAttribute;

    protected $table = 'order_item';
    protected $primaryKey = 'trade_id';
    protected $fillable = [
        'order_id', 'itemid', 'title', 'price', 'quantity',
        'image', 'sku_id', 'sku_title', 'is_gift', 'type'
    ];
    protected $appends = ['total_fee'];

    public $timestamps = false;

    /**
     * @return float|int
     */
    public function getTotalFeeAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function refund()
    {
        return $this->hasOne(Refund::class, 'trade_id', 'trade_id');
    }
}
