<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderClosed
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property string|null $reason 关闭原因
 * @property string|null $closed_at 关闭时间
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereReason($value)
 * @mixin \Eloquent
 */
class OrderClosed extends Model
{
    protected $table = 'order_closed';
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
