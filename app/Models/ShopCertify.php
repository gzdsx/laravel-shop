<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ShopCertify
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
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereLicensePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereOtherPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopCertify whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopCertify extends Model
{
    use HasDates;

    protected $table = 'shop_certify';
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
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }
}
