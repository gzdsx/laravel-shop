<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\ProductSku
 *
 * @property int $sku_id
 * @property int $itemid 商品ID
 * @property string|null $title
 * @property string|null $image 图片
 * @property string $price 价格
 * @property int $stock 库存
 * @property string|null $code SKU编码
 * @property string|null $properties 属性组合
 * @property-read \App\Models\ProductItem $item
 * @method static Builder|ProductSku newModelQuery()
 * @method static Builder|ProductSku newQuery()
 * @method static Builder|ProductSku query()
 * @method static Builder|ProductSku whereCode($value)
 * @method static Builder|ProductSku whereImage($value)
 * @method static Builder|ProductSku whereItemid($value)
 * @method static Builder|ProductSku wherePrice($value)
 * @method static Builder|ProductSku whereProperties($value)
 * @method static Builder|ProductSku whereSkuId($value)
 * @method static Builder|ProductSku whereStock($value)
 * @method static Builder|ProductSku whereTitle($value)
 * @mixin \Eloquent
 */
class ProductSku extends Model
{
    protected $table = 'product_sku';
    protected $primaryKey = 'sku_id';
    protected $fillable = ['itemid', 'title', 'image', 'code', 'price', 'stock', 'properties'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(function (Builder $builder) {
            return $builder->orderBy('sku_id');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(ProductItem::class, 'itemid', 'itemid');
    }

    /**
     * @param $amount
     */
    public function increaseStock($amount)
    {
        if ($amount > 0) $this->increment('stock', $amount);
    }

    /**
     * @param $amount
     */
    public function decreaseStock($amount)
    {
        if ($amount > 0) $this->decrement('stock', $amount);
    }
}