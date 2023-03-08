<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Order
 *
 * @property int $order_id 主键
 * @property string|null $order_no 订单编号
 * @property int $order_type 订单类型,1=普通订单,2=拼单,3=超市订单,4=外卖订单
 * @property int $order_state 订单状态:0=待付款,1=待发货,2=待收货,3=已收货,10=退款中,20=已取消
 * @property int $shop_id 门店ID
 * @property string|null $shop_name 门店名称
 * @property int $buyer_id 买家ID
 * @property string|null $buyer_name 买家账号
 * @property string|null $remark 买家留言
 * @property int $seller_id 卖家ID
 * @property string|null $seller_name 卖家账号
 * @property string $product_fee 商品总价
 * @property string $shipping_fee 配送费
 * @property string $box_fee 餐盒费
 * @property string $total_fee 订单总额
 * @property string $discount_fee 优惠金额
 * @property string $order_fee 实付金额
 * @property int $total_count 商品数量
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_state 支付状态，1=已支付，0=未支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property int $shipping_type 配送方式
 * @property int $shipping_state 发货状态，0=未发货，1=已发货
 * @property \Illuminate\Support\Carbon|null $shipping_at 发货时间
 * @property int $receive_state 收货状态，0=未收货，1=已收货
 * @property \Illuminate\Support\Carbon|null $receive_at 收货时间
 * @property int $buyer_rate 买家评价状态，0=未评价，1=已评价
 * @property int $seller_rate 卖家评价状态，0=未评价，1=已评价
 * @property int $cancel_state 取消状态
 * @property \Illuminate\Support\Carbon|null $cancel_at 取消时间
 * @property string|null $cancel_reason 取消原因
 * @property int $accept_state 受理状态
 * @property \Illuminate\Support\Carbon|null $accept_at 受理时间
 * @property int $refund_state 退款状态
 * @property \Illuminate\Support\Carbon|null $refund_at 退款时间
 * @property int $buyer_deleted 买家已删除
 * @property int $seller_deleted 卖家已删除
 * @property string|null $out_trade_no 第三方支付订单号
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $buyer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDiscount[] $discounts
 * @property-read int|null $discounts_count
 * @property-read mixed|null $buyer_state_des
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $seller_state_des
 * @property-read mixed|null $state_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Refund[] $refunds
 * @property-read int|null $refunds_count
 * @property-read \App\Models\User|null $seller
 * @property-read \App\Models\OrderShipping|null $shipping
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \App\Models\UserTransaction|null $transaction
 * @method static Builder|Order filter(array $input = [], $filter = null)
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Order query()
 * @method static Builder|Order simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|Order whereAcceptAt($value)
 * @method static Builder|Order whereAcceptState($value)
 * @method static Builder|Order whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Order whereBoxFee($value)
 * @method static Builder|Order whereBuyerDeleted($value)
 * @method static Builder|Order whereBuyerId($value)
 * @method static Builder|Order whereBuyerName($value)
 * @method static Builder|Order whereBuyerRate($value)
 * @method static Builder|Order whereCancelAt($value)
 * @method static Builder|Order whereCancelReason($value)
 * @method static Builder|Order whereCancelState($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDiscountFee($value)
 * @method static Builder|Order whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Order whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Order whereOrderFee($value)
 * @method static Builder|Order whereOrderId($value)
 * @method static Builder|Order whereOrderNo($value)
 * @method static Builder|Order whereOrderState($value)
 * @method static Builder|Order whereOrderType($value)
 * @method static Builder|Order whereOutTradeNo($value)
 * @method static Builder|Order wherePayAt($value)
 * @method static Builder|Order wherePayState($value)
 * @method static Builder|Order wherePayType($value)
 * @method static Builder|Order whereProductFee($value)
 * @method static Builder|Order whereReceiveAt($value)
 * @method static Builder|Order whereReceiveState($value)
 * @method static Builder|Order whereRefundAt($value)
 * @method static Builder|Order whereRefundState($value)
 * @method static Builder|Order whereRemark($value)
 * @method static Builder|Order whereSellerDeleted($value)
 * @method static Builder|Order whereSellerId($value)
 * @method static Builder|Order whereSellerName($value)
 * @method static Builder|Order whereSellerRate($value)
 * @method static Builder|Order whereShippingAt($value)
 * @method static Builder|Order whereShippingFee($value)
 * @method static Builder|Order whereShippingState($value)
 * @method static Builder|Order whereShippingType($value)
 * @method static Builder|Order whereShopId($value)
 * @method static Builder|Order whereShopName($value)
 * @method static Builder|Order whereTotalCount($value)
 * @method static Builder|Order whereTotalFee($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use Filterable, HasDates;

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_id', 'order_no', 'order_type', 'order_state', 'shop_id', 'shop_name', 'buyer_id', 'buyer_name',
        'remark', 'seller_id', 'seller_name', 'product_fee', 'shipping_fee', 'box_fee', 'total_fee',
        'discount_fee', 'order_fee', 'total_count', 'pay_type', 'pay_state', 'pay_at',
        'shipping_state', 'shipping_at', 'receive_state', 'receive_at',
        'buyer_rate', 'seller_rate', 'cancel_state', 'cancel_at', 'cancel_reason', 'accept_state',
        'accept_at', 'refund_state', 'refund_at', 'buyer_deleted', 'seller_deleted', 'transaction_id',
        'is_hot', 'out_trade_no'
    ];

    protected $dates = [
        'pay_at',
        'shipping_at',
        'receive_at',
        'cancel_at',
        'accept_at',
        'refund_at'
    ];
    protected $appends = [
        'state_des',
        'pay_type_des',
        'pay_state_des'
    ];
    protected $casts = [
        'is_hot' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function (Order $order) {
            $order->shipping()->create();
        });

        static::deleting(function (Order $order) {
            $order->items()->delete();
            $order->logs()->delete();
            $order->refunds()->delete();
            $order->shipping()->delete();
            $order->discounts()->delete();
        });
    }

    /**
     * @return mixed|null
     */
    public function getStateDesAttribute()
    {
        return is_null($this->order_state) ?: trans('order.order_states.' . $this->order_state);
    }

    /**
     * @return mixed|null
     */
    public function getBuyerStateDesAttribute()
    {
        return is_null($this->order_state) ?: trans('order.order_states.' . $this->order_state);
    }

    /**
     * @return mixed|null
     */
    public function getSellerStateDesAttribute()
    {
        return is_null($this->order_state) ?: trans('order.order_states.' . $this->order_state);
    }

    /**
     * @return mixed|null
     */
    public function getPayTypeDesAttribute()
    {
        return is_null($this->pay_type) ?: trans('trade.pay_types.' . $this->pay_type);
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getPayStateDesAttribute()
    {
        return is_null($this->pay_state) ?: trans('trade.pay_states.' . $this->pay_state);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(OrderLog::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Refund[]
     */
    public function refunds()
    {
        return $this->hasMany(Refund::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|OrderShipping
     */
    public function shipping()
    {
        return $this->hasOne(OrderShipping::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|OrderItem
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|EcomShop
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|UserTransaction
     */
    public function transaction()
    {
        return $this->hasOne(UserTransaction::class, 'out_trade_no', 'order_no');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discounts()
    {
        return $this->hasMany(OrderDiscount::class, 'order_id', 'order_id');
    }

    /**
     * @param $order_no
     * @return Builder|Model|Order|object|null
     */
    public static function findByOrderNo($order_no)
    {
        return Order::where('order_no', $order_no)->first();
    }

    public function markAsPaid()
    {
        $this->forceFill([
            'order_state' => 1,
            'pay_state' => 1,
            'pay_at' => now()
        ])->save();
    }


    public function markAsUnPaid()
    {
        $this->forceFill([
            'order_state' => 0,
            'pay_state' => 0,
            'pay_at' => null
        ])->save();
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        return $this->pay_state == 1;
    }

    /**
     * @return bool
     */
    public function isUnPaid()
    {
        return $this->pay_state == 0;
    }

    public function markAsShipped()
    {
        $this->forceFill([
            'order_state' => 2,
            'shipping_state' => 1,
            'shipping_at' => now()
        ])->save();
    }

    /**
     * @return bool
     */
    public function isShipped()
    {
        return $this->shipping_state == 1;
    }

    public function markAsReceived()
    {
        $this->forceFill([
            'order_state' => 3,
            'receive_state' => 1,
            'receive_at' => now()
        ])->save();
    }

    /**
     * @return bool
     */
    public function isReceived()
    {
        return $this->receive_state == 1;
    }

    public function markAsCancelled()
    {
        $this->forceFill([
            'order_state' => 20,
            'cancel_state' => 1,
            'cancel_at' => now()
        ])->save();
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->cancel_state == 1;
    }

    public function markAsAccepted()
    {
        $this->forceFill([
            'accept_state' => 1,
            'accept_at' => now()
        ])->save();
    }

    public function markAsRefunded()
    {
        return $this->forceFill([
            'refund_state' => 1,
            'refund_at' => now()
        ])->save();
    }
}
