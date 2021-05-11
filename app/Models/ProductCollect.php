<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductCollect
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $itemid 产品ID
 * @property string|null $title 产品名称
 * @property string $image 图片
 * @property string $price 价格
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \App\Models\ProductItem $product
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
    use HasImageAttribute, HasDates;

    protected $table = 'product_collect';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'itemid', 'title', 'image', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductItem::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
