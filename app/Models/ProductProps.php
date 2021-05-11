<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\ProductProps
 *
 * @property int $id 主键
 * @property int $itemid 产品ID
 * @property int $prop_id 属性ID
 * @property string|null $prop_name 属性名称
 * @property string|null $prop_value 属性值
 * @property-read \App\Models\ProductItem $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps wherePropName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps wherePropValue($value)
 * @mixin \Eloquent
 */
class ProductProps extends Model
{
    protected $table = 'product_props';
    protected $primaryKey = 'id';
    protected $fillable = ['itemid', 'prop_id', 'prop_name', 'prop_value'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductItem::class, 'itemid', 'itemid');
    }
}
