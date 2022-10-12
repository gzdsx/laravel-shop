<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomProductTemplate
 *
 * @property int $template_id 模板ID
 * @property int $shop_id 店铺ID
 * @property string|null $template_name 模板名称
 * @property string|null $template_info 描述
 * @property int $valuation 计价方式
 * @property int $start_quantity 默认数量
 * @property string $start_fee 默认运费
 * @property int $growth_quantity 递增数量
 * @property string $growth_fee 递增运费
 * @property string|null $delivery_areas 配送区域
 * @property string $free_amount 包邮金额
 * @property int $free_quantity 包邮数量
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereDeliveryAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereFreeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereFreeQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereGrowthFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereGrowthQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereStartFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereStartQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereTemplateInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereValuation($value)
 * @mixin \Eloquent
 */
class EcomProductTemplate extends Model
{
    protected $table = 'ecom_product_template';
    protected $primaryKey = 'template_id';
    protected $fillable = [
        'template_id', 'shop_id', 'template_name', 'template_info', 'valuation', 'start_quantity',
        'start_fee', 'growth_quantity', 'growth_fee', 'delivery_areas', 'free_amount', 'free_quantity'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }
}
