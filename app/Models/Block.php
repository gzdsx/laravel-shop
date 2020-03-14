<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Block
 *
 * @property int $block_id
 * @property string|null $block_name
 * @property string|null $block_desc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BlockItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockName($value)
 * @mixin \Eloquent
 */
class Block extends Model
{
    protected $table = 'block';
    protected $primaryKey = 'block_id';
    protected $fillable = ['block_name','block_desc'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(BlockItem::class, 'block_id', 'block_id');
    }
}
