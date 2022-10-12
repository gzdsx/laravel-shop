<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTransaction
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $type 交易类型:1=收入,2=支出
 * @property int $account_type 财务类型
 * @property string|null $out_trade_no 交易流水
 * @property string|null $pay_type 支付方式
 * @property int $pay_state 支付状态,0=未支付，1=已支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property string|null $detail 交易说明
 * @property string $amount 交易金额
 * @property string|null $memo 交易备注
 * @property array|null $data 付款信息
 * @property int $other_account_id 对方账户ID
 * @property string|null $other_account_name 对方账户名称
 * @property \Illuminate\Support\Carbon|null $created_at 交易时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $type_des
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User|null $otherAccount
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereOtherAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereOtherAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserTransaction extends Model
{
    use Filterable, HasDates;

    protected $table = 'user_transaction';
    protected $primaryKey = 'id';
    protected $appends = [
        'pay_type_des',
        'pay_state_des',
        'type_des'
    ];
    protected $fillable = [
        'uid', 'type', 'account_type', 'out_trade_no', 'pay_type', 'pay_state', 'pay_at',
        'detail', 'amount', 'memo', 'data', 'other_account_id', 'other_account_name'
    ];
    protected $dates = ['pay_at'];
    protected $casts = [
        'data' => 'array',
    ];
    protected $with = ['user', 'otherAccount'];

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
        return $this->hasOne(Order::class, 'transaction_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function otherAccount()
    {
        return $this->belongsTo(User::class, 'other_account_id', 'uid');
    }

    /**
     * @param $out_trade_no
     * @return UserTransaction|\Illuminate\Database\Eloquent\Builder|UserTransaction|Model|object|null
     */
    public static function findByOutTradeNo($out_trade_no)
    {
        return UserTransaction::whereOutTradeNo($out_trade_no)->first();
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
