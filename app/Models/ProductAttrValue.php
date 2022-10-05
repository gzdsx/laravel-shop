<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductAttrValue
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_value 属性值
 * @property int $attr_cate_id 分类ID
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue whereAttrCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue whereAttrValue($value)
 * @mixin \Eloquent
 */
class ProductAttrValue extends Model
{
    protected $table = 'product_attr_value';
    protected $primaryKey = 'attr_id';
    protected $fillable = ['attr_value', 'attr_cate_id'];
    protected $hidden = ['attr_cate_id'];

    public $timestamps = false;
}
