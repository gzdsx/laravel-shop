<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderClosed
 *
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason query()
 * @mixin \Eloquent
 */
class OrderCloseReason extends Model
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
