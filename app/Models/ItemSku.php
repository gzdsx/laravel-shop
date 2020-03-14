<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemSku
 *
 * @property int $sku_id
 * @property int $itemid 商品ID
 * @property string|null $sku_properties 属性组合
 * @property float $sku_price 价格
 * @property int $sku_stock 库存
 * @property string|null $sku_code 商家编码
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereSkuCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereSkuPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereSkuProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereSkuStock($value)
 * @mixin \Eloquent
 */
class ItemSku extends Model
{
    protected $table = 'item_sku';
    protected $primaryKey = 'sku_id';
    protected $fillable = ['itemid', 'sku_properties', 'sku_price', 'sku_stock', 'sku_code'];

    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }
}
