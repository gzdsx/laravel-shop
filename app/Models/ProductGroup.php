<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductGroup
 *
 * @property int $group_id 主键
 * @property int $uid 团长ID
 * @property int $itemid 产品ID
 * @property int $order_id 订单ID
 * @property int $num 需求人数
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGroupItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\ProductItem $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductGroup extends Model
{
    use HasDates;

    protected $table = 'product_group';
    protected $primaryKey = 'group_id';
    protected $fillable = ['uid', 'itemid', 'order_id', 'num', 'state'];
    protected $with = ['user'];

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
    public function product()
    {
        return $this->belongsTo(ProductItem::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ProductGroupItem::class, 'group_id', 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
