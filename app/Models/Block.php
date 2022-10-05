<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Block
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BlockItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereName($value)
 * @mixin \Eloquent
 */
class Block extends Model
{
    protected $table = 'block';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];

    public $timestamps = false;


    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleting(function (Block $block) {
            $block->items()->delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(BlockItem::class, 'block_id', 'id');
    }
}
