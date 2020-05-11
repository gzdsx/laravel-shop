<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderAction
 *
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog query()
 * @mixin \Eloquent
 */
class OrderLog extends Model
{
    protected $table = 'order_action';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'uid', 'username', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
