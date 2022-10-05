<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShopStats
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
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereDaySales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereDayTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereDayVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereMonthSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereMonthTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereMonthVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereTotalSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereTotalTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopStats whereTotalVisitors($value)
 * @mixin \Eloquent
 */
class ShopStats extends Model
{
    protected $table = 'shop_stats';
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
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }
}
