<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrderShipping
 *
 * @property int $id 主键
 * @property int $order_id 订单ID
 * @property string|null $express_code 快递公司编号
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $phone 联系电话
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $street 街道
 * @property float $latitude 纬度
 * @property float $longitude 经度
 * @property string|null $postalcode 邮政编码
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read string $formatted_address
 * @property-read \App\Models\Order|null $order
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
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderShipping extends Model
{
    use HasDates;

    protected $table = 'order_shipping';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id', 'express_code', 'express_name', 'express_no', 'name', 'phone',
        'province', 'city', 'district', 'street', 'postalcode', 'latitude', 'longitude'
    ];
    protected $appends = ['formatted_address'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
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
