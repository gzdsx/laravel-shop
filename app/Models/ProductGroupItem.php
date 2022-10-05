<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductGroupItem
 *
 * @property int $id 主键
 * @property int $group_id 团ID
 * @property int $uid 用户ID
 * @property int|null $itemid 产品ID
 * @property int|null $order_id 订单ID
 * @property int $is_chief 是否团长
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property-read \App\Models\ProductGroup $group
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereIsChief($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGroupItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductGroupItem extends Model
{
    use HasDates;

    protected $table = 'product_group_item';
    protected $primaryKey = 'id';
    protected $fillable = ['group_id', 'uid', 'itemid', 'order_id', 'is_chief'];

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
    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'group_id', 'group_id');
    }
}
