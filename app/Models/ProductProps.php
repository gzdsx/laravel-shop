<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\ProductProps
 *
 * @property int $id
 * @property int $itemid
 * @property int $prop_id
 * @property string|null $prop_name
 * @property string|null $prop_value
 * @property-read \App\Models\ProductItem $item
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
