<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\Order
 *
 * @property int $order_id
 * @property int $order_type 订单类型
 * @property string|null $order_no 订单编号
 * @property int $order_state 订单状态,1=未付款,2=已付款,3=已发货,4=交易完成,5=退货中,6=交易关闭
 * @property int $buyer_uid 买家ID
 * @property string|null $buyer_name 买家账号
 * @property string|null $remark 买家留言
 * @property float $order_fee 订单费用
 * @property float $shipping_fee 运费
 * @property float $total_fee 付款金额
 * @property int $total_count 商品数量
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_state 支付状态，1=已支付，0=未支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property int $shipping_state 发货状态，0=未发货，1=已发货
 * @property \Illuminate\Support\Carbon|null $shipping_at 发货时间
 * @property int $receive_state 收货状态，0=未收货，1=已收货
 * @property \Illuminate\Support\Carbon|null $receive_at 收货时间
 * @property int $buyer_rate 评价状态，0=未评价，1=已评价
 * @property int $seller_rate 卖家评价状态
 * @property int $refund_state 退款状态，0=无退款，1=退款中，2=退款完成
 * @property \Illuminate\Support\Carbon|null $refund_at 退款时间
 * @property int $closed 关闭状态
 * @property \Illuminate\Support\Carbon|null $closed_at 关闭时间
 * @property int $buyer_deleted 买家已删除
 * @property int $seller_deleted 卖家已删除
 * @property \Illuminate\Support\Carbon|null $finished_at 成交时间
 * @property int $transaction_id 关联流水记录
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderAction[] $actions
 * @property-read int|null $actions_count
 * @property-read \App\Models\User $buyer
 * @property-read \App\Models\OrderClosed $closeReason
 * @property-read mixed|null $buyer_state_des
 * @property-read mixed|null $order_state_des
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $seller_state_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Refund $refund
 * @property-read \App\Models\User $seller
 * @property-read \App\Models\OrderShipping $shipping
 * @property-read \App\Models\Transaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReceiveAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReceiveState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use Filterable;

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $observables = ['created', 'updated'];
    protected $dates = [
        'created_at',
        'updated_at',
        'pay_at',
        'shipping_at',
        'receive_at',
        'refund_at',
        'finished_at',
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
        'order_id', 'order_type', 'order_no', 'order_state', 'buyer_uid', 'buyer_name',
        'buyer_message', 'order_fee', 'shipping_fee', 'total_fee', 'total_count', 'pay_type', 'pay_state', 'pay_at',
        'shipping_state', 'shipping_at', 'receive_state', 'receive_at', 'buyer_rate',
        'seller_rate', 'refund_state', 'refund_at', 'closed', 'closed_at', 'buyer_deleted',
        'seller_deleted', 'finished_at', 'out_trade_no', 'transaction_id'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (Order $order) {
            if (!$order->order_no) $order->order_no = createOrderNo();
            if (!$order->buyer_uid) $order->buyer_uid = Auth::id();
        });

        static::created(function (Order $order) {
            $order->shipping()->create();
        });

        static::deleted(function (Order $order) {
            $order->items()->delete();
            $order->actions()->delete();
            $order->closeReason()->delete();
            $order->refund()->delete();
            $order->shipping()->delete();
        });

        static::addGlobalScope('visiable', function (Builder $builder) {
            return $builder->where('buyer_deleted', 0)->where('seller_deleted', 0);
        });
    }

    /**
     * @return mixed|null
     */
    public function getOrderStateDesAttribute()
    {
        if (isset($this->attributes['order_state'])) {
            return trans('trade.order_states.' . $this->attributes['order_state']);
        }
        return null;
    }

    /**
     * @return mixed|null
     */
    public function getBuyerStateDesAttribute()
    {
        if (isset($this->attributes['order_state'])) {
            return trans('trade.buyer_order_states.' . $this->attributes['order_state']);
        }
        return null;
    }

    /**
     * @return mixed|null
     */
    public function getSellerStateDesAttribute()
    {
        if (isset($this->attributes['order_state'])) {
            return trans('trade.seller_order_states.' . $this->attributes['order_state']);
        }
        return null;
    }

    /**
     * @return mixed|null
     */
    public function getPayTypeDesAttribute()
    {
        if (isset($this->attributes['pay_type'])) {
            return trans('trade.pay_types.' . $this->attributes['pay_type']);
        }
        return null;
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getPayStateDesAttribute()
    {
        if (isset($this->attributes['pay_state'])) {
            return trans('payment.pay_states.' . $this->attributes['pay_state']);
        }
        return null;
    }

    /**
     * 更改为付款状态
     * @return bool
     */
    public function changeToPaid()
    {
        $this->order_state = 2;
        $this->pay_state = 1;
        $this->pay_at = time();
        if ($this->transaction) {
            $this->transaction->transaction_state = 2;
            $this->transaction->pay_state = 1;
            $this->transaction->pay_at = time();
        }
        return $this->push();
    }

    /**
     * 更改为发货状态
     * @return bool
     */
    public function changeToSend()
    {
        $this->order_state = 3;
        $this->shipping_state = 1;
        $this->shipping_at = time();
        if ($transaction = $this->transaction) {
            $this->transaction->transaction_state = 3;
        }
        return $this->push();
    }

    /**
     * 更改为收货状态
     * @return bool
     */
    public function changeToReceived()
    {
        $this->order_state = 4;
        $this->receive_state = 1;
        $this->receive_at = time();
        if ($transaction = $this->transaction) {
            $this->transaction->transaction_state = 4;
        }
        return $this->push();
    }

    /**
     * 更改为退款中
     * @return bool
     */
    public function changeToRefunding()
    {
        $this->order_state = 5;
        $this->refund_state = 1;
        $this->refund_at = time();
        if ($transaction = $this->transaction) {
            $this->transaction->transaction_state = 5;
        }
        return $this->push();
    }

    /**
     * 更改为退款完成
     * @return bool
     */
    public function changeToRefunded()
    {
        $this->order_state = 6;
        $this->refund_state = 2;
        $this->refund_at = time();
        $this->closed = 1;
        $this->closed_at = time();
        if ($transaction = $this->transaction) {
            $this->transaction->transaction_state = 6;
        }
        return $this->push();
    }

    /**
     * 更改为关闭状态
     * @return bool
     */
    public function changeToClosed()
    {
        $this->order_state = 6;
        $this->closed = 1;
        $this->closed_at = time();
        if ($transaction = $this->transaction) {
            $this->transaction->transaction_state = 6;
        }
        return $this->push();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany(OrderAction::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function closeReason()
    {
        return $this->hasOne(OrderClosed::class, 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function refund()
    {
        return $this->hasOne(Refund::class, 'order_id', 'order_id');
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
        return $this->belongsTo(User::class, 'buyer_uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'transaction_id', 'transaction_id');
    }
}
