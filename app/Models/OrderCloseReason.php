<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderClosed
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property string|null $reason 关闭原因
 * @property \Illuminate\Support\Carbon|null $created_at 关闭时间
 * @property \Illuminate\Support\Carbon|null $updated_at 关闭时间
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderCloseReason extends Model
{
    use HasDates;

    protected $table = 'order_close_reason';
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_id', 'reason'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
