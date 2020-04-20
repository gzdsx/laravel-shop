<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemCate
 *
 * @property int $id
 * @property int|null $itemid
 * @property int|null $catid
 * @property-read \App\Models\ItemCatlog|null $catlog
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCate whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCate whereItemid($value)
 * @mixin \Eloquent
 */
class ItemCate extends Model
{
    protected $table = 'item_cate';
    protected $fillable = ['itemid', 'catid'];
    public $timestamps = false;

    public function catlog()
    {
        return $this->belongsTo(ItemCatlog::class, 'catid', 'catid');
    }
}
