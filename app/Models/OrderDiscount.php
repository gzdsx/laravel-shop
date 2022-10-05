<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderDiscount
 *
 * @property int $id 主键
 * @property int $order_id 订单ID
 * @property string|null $title 名称
 * @property string $amount 减免金额
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereTitle($value)
 * @mixin \Eloquent
 */
class OrderDiscount extends Model
{
    protected $table = 'order_discount';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'title', 'amount'];
    public $timestamps = false;
}
