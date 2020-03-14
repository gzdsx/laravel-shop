<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemProps
 *
 * @property int $id
 * @property int $itemid
 * @property int $prop_id
 * @property string|null $prop_name
 * @property string|null $prop_value
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps wherePropName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemProps wherePropValue($value)
 * @mixin \Eloquent
 */
class ItemProps extends Model
{
    protected $table = 'item_props';
    protected $primaryKey = 'id';
    protected $fillable = ['itemid', 'prop_id', 'prop_name', 'prop_value'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }
}
