<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomProductCategory
 *
 * @property int $cate_id 主键
 * @property string|null $cate_name 分类名称
 * @property int $parent_id 父级分类
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $level 级别
 * @property int $available 是否可用
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property int $sort_num 显示顺序
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read ProductCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateList($value)
 * @mixin \Eloquent
 */
class ProductCategory extends CategoryModel
{
    protected $table = 'product_category';

    /**
     * @return string
     */
    public static function cacheName()
    {
        // TODO: Implement cacheName() method.
        return 'product_categories';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        // TODO: Implement getUrlAttribute() method.
        return url('ecom/category/' . $this->cate_id . '.html');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(
            ProductItem::class,
            'ecom_product_item_category',
            'product_cate_id',
            'product_id',
            'cate_id',
            'itemid'
        );
    }
}
