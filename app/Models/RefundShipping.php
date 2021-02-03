<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $refund_id 订单ID
 * @property string|null $express_code
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Refund $refund
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RefundShipping extends Model
{
    protected $table = 'refund_shipping';
    protected $primaryKey = 'id';
    protected $fillable = [
        'refund_id', 'express_code', 'express_name', 'express_no',
        'name', 'tel', 'province', 'city', 'district', 'street', 'postalcode'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refund()
    {
        return $this->belongsTo(Refund::class, 'refund_id', 'refund_id');
    }
}