<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BuyLog
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $buyable_type 类型
 * @property int $buyable_id 类型ID
 * @property int $pay_state 支付状态
 * @property int $transaction_id 交易ID
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\Transaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereBuyableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereBuyableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BuyLog extends Model
{
    use HasDates;

    protected $table = 'buy_log';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'buyable_type', 'buyable_id', 'transaction_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    /**
     * @param $transaction_id
     * @return BuyLog|\Illuminate\Database\Eloquent\Builder|Model|Transaction|object|null
     */
    public static function findByTransactionId($transaction_id)
    {
        return BuyLog::whereTransactionId($transaction_id)->first();
    }
}
