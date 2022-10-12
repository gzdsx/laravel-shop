<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomShopCertify
 *
 * @property int $id 主键
 * @property int $shop_id 店铺ID
 * @property string|null $name 店主姓名
 * @property string|null $id_card_no 店主身份证号
 * @property string|null $id_card_front 身份证正面照
 * @property string|null $id_card_back 身份证背面照
 * @property string|null $id_card_hand 手持身份证照
 * @property string|null $license_pic 营业执照照片
 * @property string|null $other_pic 其它证件照片
 * @property string|null $scope 经营范围
 * @property int $state 审核状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereLicensePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereOtherPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EcomShopCertify extends Model
{
    use HasDates;

    protected $table = 'ecom_shop_certify';
    protected $primaryKey = 'id';
    protected $fillable = [
        'shop_id', 'name', 'id_card_no', 'id_card_front', 'id_card_back',
        'id_card_hand', 'license_pic', 'other_pic', 'scope', 'state'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }
}
