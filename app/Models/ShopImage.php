<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ShopImage
 *
 * @property int $id 主键
 * @property int $shop_id 门店ID
 * @property string|null $thumb 小图
 * @property string $image 图片
 * @property int $sort_num 排序
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopImage whereThumb($value)
 * @mixin \Eloquent
 */
class ShopImage extends Model
{
    use HasImageAttribute;

    protected $table = 'shop_image';
    protected $primaryKey = 'id';
    protected $fillable = ['shop_id', 'thumb', 'image', 'sort_num'];
    public $timestamps = false;
}
