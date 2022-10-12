<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Block
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommonBlockItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock whereName($value)
 * @mixin \Eloquent
 */
class CommonBlock extends Model
{
    protected $table = 'common_block';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];

    public $timestamps = false;


    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleting(function (CommonBlock $block) {
            $block->items()->delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(CommonBlockItem::class, 'block_id', 'id');
    }
}
