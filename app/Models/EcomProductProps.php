<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomProductProps
 *
 * @property int $id 主键
 * @property int $itemid 产品ID
 * @property int $prop_id 属性ID
 * @property string|null $prop_name 属性名称
 * @property string|null $prop_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps wherePropName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps wherePropValue($value)
 * @mixin \Eloquent
 */
class EcomProductProps extends Model
{
    protected $table = 'ecom_product_props';
    protected $primaryKey = 'id';
    protected $fillable = ['itemid', 'prop_id', 'prop_name', 'prop_value'];

    public $timestamps = false;
}
