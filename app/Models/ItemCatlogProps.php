<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemCatlogProps
 *
 * @property int $prop_id
 * @property int $catid
 * @property string|null $title
 * @property string|null $type
 * @property int $required
 * @property string|null $default
 * @property string|null $options
 * @property string|null $rules
 * @property-read \App\Models\ItemCatlog $catlog
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlogProps whereType($value)
 * @mixin \Eloquent
 */
class ItemCatlogProps extends Model
{
    protected $table = 'item_catlog_props';
    protected $primaryKey = 'prop_id';
    protected $fillable = ['catid','title','type','required','default','options','rules'];

    public $timestamps = false;

    public function catlog()
    {
        return $this->belongsTo(ItemCatlog::class, 'catid', 'catid');
    }
}
