<?php

namespace App\Models;

use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\Order
 *
 * @property int $order_id 主键
 * @property int $order_type 订单类型
 * @property string|null $order_no 订单编号
 * @property int $order_state 订单状态:1=未付款,2=已付款,3=已发货,4=交易成功,5=交易关闭
 * @property int $buyer_id 买家ID
 * @property string|null $buyer_name 买家账号
 * @property string|null $remark 买家留言
 * @property string $goods_fee 商品总价
 * @property string $shipping_fee 运费
 * @property string $discount_fee 优惠金额
 * @property string $order_fee 付款金额
 * @property string $total_fee 订单总额
 * @property int $coupon_id 优惠券
 * @property int $total_count 商品数量
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_state 支付状态，1=已支付，0=未支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property int $shipping_state 发货状态，0=未发货，1=已发货
 * @property \Illuminate\Support\Carbon|null $shipping_at 发货时间
 * @property int $receive_state 收货状态，0=未收货，1=已收货
 * @property \Illuminate\Support\Carbon|null $receive_at 收货时间
 * @property int $buyer_rate 买家评价状态，0=未评价，1=已评价
 * @property int $seller_rate 卖家评价状态，0=未评价，1=已评价
 * @property int $refund_state 退款状态，0=无退款，1=退款中，2=退款完成
 * @property \Illuminate\Support\Carbon|null $refund_at 退款时间
 * @property int $closed 关闭状态
 * @property \Illuminate\Support\Carbon|null $closed_at 关闭时间
 * @property int $buyer_deleted 买家已删除
 * @property int $seller_deleted 卖家已删除
 * @property int|null $transaction_id 关联交易记录
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $buyer
 * @property-read \App\Models\OrderCloseReason|null $closeReason
 * @property-read mixed|null $buyer_state_des
 * @property-read mixed|null $order_state_des
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $seller_state_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Refund[] $refunds
 * @property-read int|null $refunds_count
 * @property-read \App\Models\OrderShipping|null $shipping
 * @property-read \App\Models\Transaction|null $transaction
 * @method static Builder|Order filter(array $input = [], $filter = null)
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Order query()
 * @method static Builder|Order simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|Order whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Order whereBuyerDeleted($value)
 * @method static Builder|Order whereBuyerId($value)
 * @method static Builder|Order whereBuyerName($value)
 * @method static Builder|Order whereBuyerRate($value)
 * @method static Builder|Order whereClosed($value)
 * @method static Builder|Order whereClosedAt($value)
 * @method static Builder|Order whereCouponId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDiscountFee($value)
 * @method static Builder|Order whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Order whereGoodsFee($value)
 * @method static Builder|Order whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Order whereOrderFee($value)
 * @method static Builder|Order whereOrderId($value)
 * @method static Builder|Order whereOrderNo($value)
 * @method static Builder|Order whereOrderState($value)
 * @method static Builder|Order whereOrderType($value)
 * @method static Builder|Order wherePayAt($value)
 * @method static Builder|Order wherePayState($value)
 * @method static Builder|Order wherePayType($value)
 * @method static Builder|Order whereReceiveAt($value)
 * @method static Builder|Order whereReceiveState($value)
 * @method static Builder|Order whereRefundAt($value)
 * @method static Builder|Order whereRefundState($value)
 * @method static Builder|Order whereRemark($value)
 * @method static Builder|Order whereSellerDeleted($value)
 * @method static Builder|Order whereSellerRate($value)
 * @method static Builder|Order whereShippingAt($value)
 * @method static Builder|Order whereShippingFee($value)
 * @method static Builder|Order whereShippingState($value)
 * @method static Builder|Order whereTotalCount($value)
 * @method static Builder|Order whereTotalFee($value)
 * @method static Builder|Order whereTransactionId($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use Filterable;

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $dates = [
        'pay_at',
        'shipping_at',
        'receive_at',
        'refund_at',
        'closed_at'
    ];
    protected $appends = [
        'order_state_des',
        'buyer_state_des',
        'seller_state_des',
        'pay_type_des',
        'pay_state_des'
    ];

    protected $fillable = [
        'order_type', 'order_no', 'order_state', 'buyer_id', 'buyer_name', 'remark', 'goods_fee',
        'order_fee', 'shipping_fee', 'discount_fee', 'total_fee', 'coupon_id', 'total_count',
        'pay_type', 'pay_state', 'pay_at', 'shipping_state', 'shipping_at', 'receive_state', 'receive_at',
        'buyer_rate', 'seller_rate', 'refund_state', 'refund_at', 'closed', 'closed_at', 'buyer_deleted', 'seller_deleted',
        'transaction_id'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function (Order $order) {
            $order->shipping()->create();
        });

        static::deleted(function (Order $order) {
            $order->items()->delete();
            $order->logs()->delete();
            $order->closeReason()->delete();
            $order->refunds()->delete();
            $order->shipping()->delete();
            $order->transaction()->delete();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    /**
     * @return mixed|null
     */
    public function getOrderStateDesAttribute()
    {
        return is_null($this->order_state) ?: trans('trade.order_states.' . $this->order_state);
    }

    /**
     * @return mixed|null
     */
    public function getBuyerStateDesAttribute()
    {
        return is_null($this->order_state) ?: trans('trade.buyer_order_states.' . $this->order_state);
    }

    /**
     * @return mixed|null
     */
    public function getSellerStateDesAttribute()
    {
        return is_null($this->order_state) ?: trans('trade.seller_order_states.' . $this->order_state);
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
        return is_null($this->pay_state) ?: trans('transaction.pay_states.' . $this->pay_state);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(OrderLog::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function closeReason()
    {
        return $this->hasOne(OrderCloseReason::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Refund[]
     */
    public function refunds()
    {
        return $this->hasMany(Refund::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipping()
    {
        return $this->hasOne(OrderShipping::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    /**
     * @param $order_no
     * @return Builder|Model|object|null
     */
    public static function findByOrderNo($order_no)
    {
        return Order::where('order_no', $order_no)->first();
    }
}
