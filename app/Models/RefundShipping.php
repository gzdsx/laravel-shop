<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\RefundShipping
 *
 * @property int $id 主键
 * @property int $refund_id 订单ID
 * @property string|null $express_code 快递编码
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $phone 联系电话
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $street 街道
 * @property string|null $postalcode 邮编
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read string $formatted_address
 * @property-read \App\Models\Refund|null $refund
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RefundShipping extends Model
{
    use HasDates;

    protected $table = 'refund_shipping';
    protected $primaryKey = 'id';
    protected $fillable = [
        'refund_id', 'express_code', 'express_name', 'express_no', 'name', 'phone',
        'province', 'city', 'district', 'street', 'postalcode'
    ];
    protected $appends = ['formatted_address'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refund()
    {
        return $this->belongsTo(Refund::class, 'refund_id', 'refund_id');
    }

    /**
     * @return string
     */
    public function getFormattedAddressAttribute()
    {
        if ($this->province == $this->city) {
            return $this->city . $this->district . $this->street;
        }
        return $this->province . $this->city . $this->district . $this->street;
    }
}
