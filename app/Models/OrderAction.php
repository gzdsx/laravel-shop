<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderAction
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property int $uid 操作用户ID
 * @property string|null $username
 * @property string|null $content 操作内容
 * @property \Illuminate\Support\Carbon|null $created_at 操作时间
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUsername($value)
 * @mixin \Eloquent
 */
class OrderAction extends Model
{
    protected $table = 'order_action';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'uid', 'username', 'content', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
