<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property int $shipping_type
 * @property string|null $express_code 快递公司编号
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
 * @property-read string $full_address
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderShipping extends Model
{
    protected $table = 'order_shipping';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id', 'shipping_type', 'express_code', 'express_name', 'express_no',
        'name', 'tel', 'province', 'city', 'district', 'street', 'postalcode'
    ];
    protected $appends = ['full_address'];


    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->province . $this->city . $this->district . $this->street;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
