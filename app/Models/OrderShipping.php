<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property string|null $express_code 快递公司编号
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $tel 联系电话
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_address
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderShipping extends Model
{
    use HasDates;

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
