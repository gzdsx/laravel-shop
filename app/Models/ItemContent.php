<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemContent
 *
 * @property int $itemid
 * @property string|null $content
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereItemid($value)
 * @mixin \Eloquent
 */
class ItemContent extends Model
{
    protected $table = 'item_content';
    protected $primaryKey = 'itemid';
    protected $fillable = ['itemid', 'content'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }
}
