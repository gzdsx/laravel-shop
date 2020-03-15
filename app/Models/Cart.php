<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $uid
 * @property int $shop_id
 * @property int $itemid
 * @property string|null $title
 * @property int $quantity
 * @property float $price 商品价格
 * @property string $thumb
 * @property string $image
 * @property int $sku_id
 * @property string|null $sku_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Item $item
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart groupByShop()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSkuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'itemid', 'title', 'quantity', 'price',
        'thumb', 'image', 'sku_id', 'sku_name', 'created_at', 'updated_at'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getThumbAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setThumbAttribute($value)
    {
        $this->attributes['thumb'] = strip_image_url($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = strip_image_url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeGroupByShop(Builder $query)
    {
        return $query->groupBy('shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Cart::class, 'shop_id', 'shop_id');
    }
}
