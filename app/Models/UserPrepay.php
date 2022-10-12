<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPrepay
 *
 * @property int $id 主键
 * @property int $uid 付款人ID
 * @property int $payable_id 关联类型ID
 * @property string $out_trade_no 单号
 * @property string|null $prepay_id 微信支付prepay_id
 * @property array|null $data 支付数据
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay wherePayableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay wherePrepayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserPrepay extends Model
{
    use HasDates;

    protected $table = 'user_prepay';
    protected $primaryKey = 'id';
    protected $fillable = ['out_trade_no', 'uid', 'payable_id', 'prepay_id', 'data'];
    protected $casts = [
        'data' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
