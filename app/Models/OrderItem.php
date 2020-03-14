<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property string|null $title 商品名称
 * @property float $price 商品价格
 * @property float $promotion_price 优惠价
 * @property float $discount 折扣比例
 * @property string $thumb 缩略图
 * @property string $image 商品图片
 * @property int $quantity 商品数量
 * @property int $sku_id 属性ID
 * @property string|null $sku_name 商品属性
 * @property float $promotion_fee 优惠费用
 * @property float $shipping_fee 运费
 * @property float $total_fee 总费用
 * @property float $redpack_amount
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePromotionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSkuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTotalFee($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id', 'itemid', 'title', 'price', 'promotion_price',
        'discount', 'thumb', 'image', 'quantity', 'sku_id',
        'sku_name', 'promotion_fee', 'shipping_fee', 'total_fee'
    ];

    public $timestamps = false;

    /**
     * @param $value
     * @return string
     */
    public function getThumbAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setThumbAttribute($value)
    {
        $this->attributes['thumb'] = $value ? str_replace(material_url(), '', $value) : $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value ? str_replace(material_url(), '', $value) : $value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }
}
