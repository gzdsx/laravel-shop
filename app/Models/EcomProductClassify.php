<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomProductClassify
 *
 * @property int $cate_id 分类ID
 * @property string|null $cate_name 分类名称
 * @property int $shop_id 店铺ID
 * @property int $parent_id 父级ID
 * @property int $sort_num 显示顺序
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereSortNum($value)
 * @mixin \Eloquent
 */
class EcomProductClassify extends Model
{
    protected $table = 'ecom_product_classify';
    protected $primaryKey = 'cate_id';
    protected $fillable = ['cate_name', 'shop_id', 'parent_id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }
}
