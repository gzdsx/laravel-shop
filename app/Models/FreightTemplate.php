<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\FreightTemplate
 *
 * @property int $template_id 模板ID
 * @property string|null $template_name 模板名称
 * @property int $valuation 计价方式
 * @property int $start_quantity 默认数量
 * @property string $start_fee 默认运费
 * @property int $growth_quantity 递增数量
 * @property string $growth_fee 递增运费
 * @property string|null $delivery_areas 配送区域
 * @property string $free_amount 包邮金额
 * @property int $free_quantity 包邮数量
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereDeliveryAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereFreeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereFreeQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereGrowthFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereGrowthQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereStartFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereStartQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereValuation($value)
 * @mixin \Eloquent
 */
class FreightTemplate extends Model
{
    protected $table = 'freight_template';
    protected $primaryKey = 'template_id';
    protected $fillable = [
        'template_id', 'template_name', 'valuation', 'start_quantity',
        'start_fee', 'growth_quantity', 'growth_fee', 'delivery_areas', 'free_amount', 'free_quantity'
    ];

    public $timestamps = false;
}
