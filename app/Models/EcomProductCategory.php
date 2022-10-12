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
 * @property-read \Illuminate\Database\Eloquent\Collection|EcomProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|EcomProductCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read EcomProductCategory|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|EcomProductCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereTemplateList($value)
 * @mixin \Eloquent
 */
class EcomProductCategory extends CategoryModel
{
    protected $table = 'ecom_product_category';

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
            EcomProductItem::class,
            'ecom_product_item_category',
            'product_cate_id',
            'product_id',
            'cate_id',
            'itemid'
        );
    }
}
