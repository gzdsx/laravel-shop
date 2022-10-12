<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomProductGroup
 *
 * @property int $group_id 主键
 * @property int $uid 团长ID
 * @property int $itemid 产品ID
 * @property int $order_id 订单ID
 * @property int $num 需求人数
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductGroupItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\EcomProductItem|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EcomProductGroup extends Model
{
    use HasDates;

    protected $table = 'ecom_product_group';
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
        return $this->belongsTo(EcomProductItem::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(EcomProductGroupItem::class, 'group_id', 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
