<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemSku
 *
 * @property int $id
 * @property int $itemid 商品ID
 * @property string|null $title
 * @property string|null $image 图片
 * @property float $price 价格
 * @property int $stock 库存
 * @property string|null $code SKU编码
 * @property string|null $properties 属性组合
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSku whereTitle($value)
 * @mixin \Eloquent
 */
class ItemSku extends Model
{
    protected $table = 'item_sku';
    protected $primaryKey = 'id';
    protected $fillable = ['itemid', 'title', 'image', 'code', 'price', 'stock', 'properties'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(function (Builder $builder){
            return $builder->orderBy('id');
        });
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }
}
