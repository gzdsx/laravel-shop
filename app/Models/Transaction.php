<?php

namespace App\Models;

use App\Support\TradeUtil;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property int $transaction_id
 * @property string|null $transaction_no 交易号
 * @property string|null $transaction_type 交易类型
 * @property int $transaction_state 交易状态
 * @property int $payer_uid 付款方ID
 * @property string|null $payer_name 付款方账号
 * @property int $payee_uid 收款方ID
 * @property string|null $payee_name 收款方账户
 * @property string|null $pay_type 支付方式
 * @property int $pay_state 支付状态,0=未支付，1=已支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property string|null $subject 交易名称
 * @property string|null $detail 交易描述
 * @property float $amount 交易金额
 * @property string|null $out_trade_no 第三方支付订单号
 * @property array|null $extra 第三方支付信息
 * @property \Illuminate\Support\Carbon|null $created_at 交易时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $transaction_state_des
 * @property-read mixed|null $transaction_type_des
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $payee
 * @property-read \App\Models\User $payer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayeeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayeeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use Filterable;

    protected $table = 'transaction';
    protected $primaryKey = 'transaction_id';
    protected $appends = [
        'pay_type_des',
        'pay_state_des',
        'transaction_state_des',
        'transaction_type_des'
    ];
    protected $fillable = [
        'transaction_id', 'transaction_no', 'transaction_type', 'transaction_state',
        'payer_uid', 'payer_name', 'payee_uid', 'payee_name', 'pay_type',
        'pay_state', 'pay_at', 'subject', 'detail', 'amount', 'out_trade_no', 'extra'
    ];
    protected $dates = ['pay_at'];
    protected $casts = [
        'extra' => 'array'
    ];


    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (Transaction $transaction) {
            if (!$transaction->transaction_no) {
                $transaction->transaction_no = TradeUtil::createTransactionNo();
            }
        });
    }

    /**
     * @return mixed|null
     */
    public function getPayTypeDesAttribute()
    {
        if (isset($this->attributes['pay_type'])) {
            return trans('payment.pay_types.' . $this->attributes['pay_type']);
        }
        return null;
    }

    /**
     * @return mixed|null
     */
    public function getPayStateDesAttribute()
    {
        if (isset($this->attributes['pay_state'])) {
            return trans('payment.pay_states.' . $this->attributes['pay_state']);
        }
        return null;
    }

    /**
     * @return mixed|null
     */
    public function getTransactionStateDesAttribute()
    {
        if (isset($this->attributes['transaction_state'])) {
            return trans('transaction.transaction_states.' . $this->attributes['transaction_state']);
        }
        return null;
    }

    /**
     * @return mixed|null
     */
    public function getTransactionTypeDesAttribute()
    {
        if (isset($this->attributes['transaction_type'])) {
            return trans('transaction.transaction_types.' . $this->attributes['transaction_type']);
        }
        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'transaction_id', 'transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_uid', 'uid');
    }
}
