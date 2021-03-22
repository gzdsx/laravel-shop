<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $itemid
 * @property string $thumb
 * @property string $image
 * @property int $displayorder
 * @property-read \App\Models\ProductItem $item
 * @method static Builder|ProductImage newModelQuery()
 * @method static Builder|ProductImage newQuery()
 * @method static Builder|ProductImage query()
 * @method static Builder|ProductImage whereDisplayorder($value)
 * @method static Builder|ProductImage whereId($value)
 * @method static Builder|ProductImage whereImage($value)
 * @method static Builder|ProductImage whereItemid($value)
 * @method static Builder|ProductImage whereThumb($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    use HasThumbAttribute, HasImageAttribute;

    protected $table = 'product_image';
    protected $primaryKey = 'id';
    protected $casts = [
        'displayorder' => 'integer'
    ];

    protected $fillable = [
        'itemid', 'thumb', 'image', 'displayorder'
    ];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('sort', function (Builder $builder) {
            return $builder->orderBy('displayorder')->orderBy('id');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(ProductItem::class, 'itemid', 'itemid');
    }
}