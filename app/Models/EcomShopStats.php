<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomShopStats
 *
 * @property int $id 主键
 * @property int $shop_id 店铺ID
 * @property string $day_turnover 日营业额
 * @property string $month_turnover 月营业额
 * @property string $total_turnover 总营业额
 * @property int $day_sales 日销量
 * @property int $month_sales 月销量
 * @property int $total_sales 总销量
 * @property int $day_visitors 日访客
 * @property int $month_visitors 月访客
 * @property int $total_visitors 总访客
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereDaySales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereDayTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereDayVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereMonthSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereMonthTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereMonthVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereTotalSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereTotalTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereTotalVisitors($value)
 * @mixin \Eloquent
 */
class EcomShopStats extends Model
{
    protected $table = 'ecom_shop_stats';
    protected $primaryKey = 'id';
    protected $fillable = [
        'shop_id', 'day_turnover', 'month_turnover', 'total_turnover', 'day_sales', 'month_sales', 'total_sales',
        'day_visitors', 'month_visitors', 'total_visitors'
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
