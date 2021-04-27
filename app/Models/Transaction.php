<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property int $transaction_id 主键
 * @property string|null $type 交易类型
 * @property string|null $out_trade_no 交易流水
 * @property int $payer_id 付款方ID
 * @property string|null $payer_name 付款方账号
 * @property int $payee_id 收款方ID
 * @property string|null $payee_name 收款方账户
 * @property string|null $pay_type 支付方式
 * @property int $pay_state 支付状态,0=未支付，1=已支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property string|null $subject 交易名称
 * @property string $amount 交易金额
 * @property string|null $remark 备注
 * @property array|null $data 付款信息
 * @property \Illuminate\Support\Carbon|null $created_at 交易时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $type_des
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User $payee
 * @property-read \App\Models\User $payer
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayeeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use Filterable, HasDates;

    protected $table = 'transaction';
    protected $primaryKey = 'transaction_id';
    protected $appends = [
        'pay_type_des',
        'pay_state_des',
        'type_des'
    ];
    protected $fillable = [
        'type', 'out_trade_no', 'payer_id', 'payer_name', 'payee_id', 'payee_name',
        'pay_type', 'pay_state', 'pay_at', 'subject', 'amount', 'remark', 'data'
    ];
    protected $dates = ['pay_at'];
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * @return mixed|null
     */
    public function getTypeDesAttribute()
    {
        return !is_null($this->type) ? trans('transaction.types.' . $this->type) : null;
    }

    /**
     * @return mixed|null
     */
    public function getPayTypeDesAttribute()
    {
        return !is_null($this->pay_type) ? trans('transaction.pay.types.' . $this->pay_type) : null;
    }

    /**
     * @return mixed|null
     */
    public function getPayStateDesAttribute()
    {
        return !is_null($this->pay_state) ? trans('transaction.pay.states.' . $this->pay_state) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'transaction_id', 'transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_id', 'uid');
    }

    /**
     * @param $out_trade_no
     * @return Transaction|\Illuminate\Database\Eloquent\Builder|Transaction|Model|object|null
     */
    public static function findByOutTradeNo($out_trade_no)
    {
        return Transaction::whereOutTradeNo($out_trade_no)->first();
    }

    public function markAsPaid()
    {
        $this->forceFill([
            'pay_state' => 1,
            'pay_at' => now()
        ])->save();
    }

    public function markAsUnPaid()
    {
        $this->forceFill([
            'pay_type' => null,
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
}
