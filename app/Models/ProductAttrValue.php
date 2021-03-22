<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductAttrValue
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue query()
 * @mixin \Eloquent
 */
class ProductAttrValue extends Model
{
    protected $table = 'product_attr_value';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'value', 'attr_id'];
    public $timestamps = false;
}
