<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrePay
 *
 * @property string $out_trade_no 单号
 * @property int|null $uid 付款人ID
 * @property string|null $username 付款人账号
 * @property string|null $prepay_id prepay_id
 * @property array|null $data 支付数据
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay wherePrepayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereUsername($value)
 * @mixin \Eloquent
 */
class PrePay extends Model
{
    use HasDates;

    protected $table = 'prepay';
    protected $primaryKey = 'out_trade_no';
    protected $keyType = 'string';
    protected $fillable = ['out_trade_no', 'uid', 'username', 'prepay_id', 'data'];
    protected $casts = [
        'data' => 'array'
    ];

    public $incrementing = false;
}
