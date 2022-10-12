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
 * @property int $quantity 商品数量
 * @property string $thumb 缩略图
 * @property string $image 商品图片
 * @property int|null $sku_id 属性ID
 * @property string|null $sku_title 商品属性
 * @property string $total_fee 订单总价
 * @property int $refund_state 退款状态
 * @property string|null $refund_at 退款时间
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundState($value)
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
        'sub_order_id', 'order_id', 'itemid', 'title', 'price', 'quantity',
        'thumb', 'image', 'sku_id', 'sku_title', 'total_fee', 'refund_state', 'refund_at'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
