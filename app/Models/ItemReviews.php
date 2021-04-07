<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemReviews
 *
 * @property int $id
 * @property int $uid 用户
 * @property int $itemid 关联商品
 * @property int $order_id 关联订单
 * @property string|null $message 评论内容
 * @property int|null $item_star 商品评分
 * @property int $service_star 服务评分
 * @property int $wuliu_star 物流评分
 * @property int $anony 匿名评论
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemReviewsImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereAnony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereItemStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereServiceStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviews whereWuliuStar($value)
 * @mixin \Eloquent
 */
class ItemReviews extends Model
{
    protected $table = 'item_reviews';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'itemid', 'order_id', 'message', 'item_star', 'service_star', 'wuliu_star', 'created_at', 'updated_at'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ItemReviewsImage::class, 'review_id', 'id');
    }
}