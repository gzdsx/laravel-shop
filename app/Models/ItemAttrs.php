<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemAttr
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_title 属性名称
 * @property string|null $attr_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrs whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrs whereAttrTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrs whereAttrValue($value)
 * @mixin \Eloquent
 */
class ItemAttrs extends Model
{
    protected $table = 'item_attrs';
    protected $primaryKey = 'attr_id';
    protected $fillable = ['attr_id', 'attr_title', 'attr_value'];
    public $timestamps = false;
}
