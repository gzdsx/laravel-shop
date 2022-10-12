<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomProductAttrValue
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_value 属性值
 * @property int $attr_cate_id 分类ID
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue whereAttrCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue whereAttrValue($value)
 * @mixin \Eloquent
 */
class EcomProductAttrValue extends Model
{
    protected $table = 'ecom_product_attr_value';
    protected $primaryKey = 'attr_id';
    protected $fillable = ['attr_value', 'attr_cate_id'];
    protected $hidden = ['attr_cate_id'];

    public $timestamps = false;
}
