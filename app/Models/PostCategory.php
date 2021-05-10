<?php

namespace App\Models;


/**
 * App\Models\PostCategory
 *
 * @property int $catid 主键
 * @property int $fid 父级分类
 * @property string|null $name 分类名称
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property int $displayorder 显示顺序
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read PostCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static Builder|CategoryModel enable()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateList($value)
 * @mixin \Eloquent
 */
class PostCategory extends CategoryModel
{
    protected $table = 'post_category';

    public static function cacheName()
    {
        // TODO: Implement cacheName() method.
        return 'post_categories';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return url('post/category/' . $this->catid);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(PostItem::class, 'catid', 'catid');
    }
}
