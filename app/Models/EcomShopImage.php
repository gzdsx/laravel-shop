<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomShopImage
 *
 * @property int $id 主键
 * @property int $shop_id 门店ID
 * @property string|null $thumb 小图
 * @property string $image 图片
 * @property int $sort_num 排序
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereThumb($value)
 * @mixin \Eloquent
 */
class EcomShopImage extends Model
{
    use HasImageAttribute;

    protected $table = 'ecom_shop_image';
    protected $primaryKey = 'id';
    protected $fillable = ['shop_id', 'thumb', 'image', 'sort_num'];
    public $timestamps = false;
}
