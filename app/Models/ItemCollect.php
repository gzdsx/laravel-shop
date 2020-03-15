<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string|null $title
 * @property string $image
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCollect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemCollect extends Model
{
    protected $table = 'item_collect';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'itemid', 'title', 'image', 'price', 'created_at', 'updated_at'];

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
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
