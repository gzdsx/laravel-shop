<?php

namespace App\Models;


/**
 * App\Models\ProductCategory
 *
 * @property int $catid 主键
 * @property int $fid 父级分类
 * @property string|null $name 分类名称
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $displayorder 显示顺序
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $items
 * @property-read int|null $items_count
 * @property-read ProductCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategoryProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryModel enable()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateList($value)
 * @mixin \Eloquent
 */
class ProductCategory extends CategoryModel
{
    protected $table = 'product_category';

    public static function cacheName()
    {
        // TODO: Implement cacheName() method.
        return 'product_categories';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(
            ProductItem::class,
            'product_cate',
            'catid',
            'itemid')->without(['category']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function props()
    {
        return $this->hasMany(ProductCategoryProps::class, 'catid', 'catid');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return url('product/category/' . $this->catid);
    }
}
