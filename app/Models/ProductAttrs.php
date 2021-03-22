<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductAttrs
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_title 属性名称
 * @property string|null $attr_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs whereAttrTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs whereAttrValue($value)
 * @mixin \Eloquent
 */
class ProductAttrs extends Model
{
    protected $table = 'product_attrs';
    protected $primaryKey = 'attr_id';
    protected $fillable = ['attr_id', 'attr_title', 'attr_value'];
    public $timestamps = false;
}
