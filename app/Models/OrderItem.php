<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\OrderItem
 *
 * @property int $sub_order_id 主键
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property string|null $title 商品名称
 * @property string $price 商品价格
 * @property string $promotion_price 促销价
 * @property string $thumb 缩略图
 * @property string $image 商品图片
 * @property int $quantity 商品数量
 * @property int|null $sku_id 属性ID
 * @property string|null $sku_title 商品属性
 * @property string $product_fee 商品总价
 * @property string $shipping_fee 运费
 * @property string $discount_fee 优惠金额
 * @property string $total_fee 订单总价
 * @property string $order_fee 实付金额
 * @property string $redpack_amount 红包金额
 * @property int $refund_id 关联退款记录
 * @property int $refund_state 退款状态
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\ProductItem|null $product
 * @property-read \App\Models\Refund $refund
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDiscountFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSubOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTotalFee($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    use HasImageAttribute, HasThumbAttribute;

    protected $table = 'order_item';
    protected $primaryKey = 'sub_order_id';
    protected $fillable = [
        'order_id', 'itemid', 'title', 'price', 'promotion_price', 'thumb', 'image', 'quantity', 'sku_id', 'sku_title',
        'product_fee', 'shipping_fee', 'total_fee', 'discount_fee', 'order_fee', 'refund_id', 'refund_state'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refund()
    {
        return $this->belongsTo(Refund::class, 'refund_id', 'refund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(ProductItem::class, 'itemid', 'itemid');
    }
}
