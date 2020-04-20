<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemAttrValue
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemAttrValue query()
 * @mixin \Eloquent
 */
class ItemAttrValue extends Model
{
    protected $table = 'item_attr_value';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'value', 'attr_id'];
    public $timestamps = false;
}
