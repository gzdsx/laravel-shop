<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string|null $title
 * @property string $image
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductItem|null $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductCollect extends Model
{
    use HasImageAttribute;

    protected $table = 'product_collect';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'itemid', 'title', 'image', 'price'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(ProductItem::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
