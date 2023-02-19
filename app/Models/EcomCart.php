<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomCart
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $shop_id 店铺ID
 * @property int $itemid 产品ID
 * @property string|null $title 产品标题
 * @property int $quantity 产品数量
 * @property string $price 商品价格
 * @property string $thumb 缩略图
 * @property string $image 大图
 * @property int $sku_id SKU ID
 * @property string|null $sku_title SKU名称
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \App\Models\EcomProductItem|null $product
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \App\Models\EcomProductSku|null $sku
 * @property-read \App\Models\User|null $user
 * @method static Builder|EcomCart newModelQuery()
 * @method static Builder|EcomCart newQuery()
 * @method static Builder|EcomCart query()
 * @method static Builder|EcomCart whereCreatedAt($value)
 * @method static Builder|EcomCart whereId($value)
 * @method static Builder|EcomCart whereImage($value)
 * @method static Builder|EcomCart whereItemid($value)
 * @method static Builder|EcomCart wherePrice($value)
 * @method static Builder|EcomCart whereQuantity($value)
 * @method static Builder|EcomCart whereShopId($value)
 * @method static Builder|EcomCart whereSkuId($value)
 * @method static Builder|EcomCart whereSkuTitle($value)
 * @method static Builder|EcomCart whereThumb($value)
 * @method static Builder|EcomCart whereTitle($value)
 * @method static Builder|EcomCart whereUid($value)
 * @method static Builder|EcomCart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EcomCart extends Model
{
    use HasImageAttribute, HasThumbAttribute, HasDates;

    protected $table = 'ecom_cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'itemid', 'shop_id', 'title', 'quantity',
        'price', 'thumb', 'image', 'sku_id', 'sku_title'
    ];
    protected $with = ['product', 'sku'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(EcomProductItem::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sku()
    {
        return $this->belongsTo(EcomProductSku::class, 'sku_id', 'sku_id');
    }
}
