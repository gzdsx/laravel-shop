<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemSkuAttr
 *
 * @property int $id 主键
 * @property int $itemid 商品ID
 * @property int $attr_id 属性ID
 * @property string|null $attr_properties 属性组合
 * @property string|null $attr_name 属性名称
 * @property string|null $attr_value 属性值
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr whereAttrName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr whereAttrProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr whereAttrValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSkuAttr whereItemid($value)
 * @mixin \Eloquent
 */
class ItemSkuAttr extends Model
{
    protected $table = 'item_sku_attr';
    protected $primaryKey = 'id';
    protected $fillable = ['itemid', 'attr_id', 'attr_properties', 'attr_name', 'attr_value'];

    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }
}
