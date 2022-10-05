<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuItem
 *
 * @property int $id 主键
 * @property int $menu_id 菜单ID
 * @property int $parent_id 父级ID
 * @property string|null $title 名称
 * @property string|null $url 链接
 * @property string $image 图片
 * @property string $target 目标
 * @property int $hide 是否隐藏
 * @property int $sort_num 显示序号
 * @property-read \Illuminate\Database\Eloquent\Collection|MenuItem[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Menu $menu
 * @property-read MenuItem $parent
 * @method static Builder|MenuItem newModelQuery()
 * @method static Builder|MenuItem newQuery()
 * @method static Builder|MenuItem query()
 * @method static Builder|MenuItem whereHide($value)
 * @method static Builder|MenuItem whereId($value)
 * @method static Builder|MenuItem whereImage($value)
 * @method static Builder|MenuItem whereMenuId($value)
 * @method static Builder|MenuItem whereParentId($value)
 * @method static Builder|MenuItem whereSortNum($value)
 * @method static Builder|MenuItem whereTarget($value)
 * @method static Builder|MenuItem whereTitle($value)
 * @method static Builder|MenuItem whereUrl($value)
 * @mixin \Eloquent
 */
class MenuItem extends Model
{
    use HasImageAttribute;

    protected $table = 'menu_item';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'menu_id', 'parent_id', 'url', 'image', 'target', 'hide', 'sort_num'];
    protected $hidden = ['menu_id'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();;
        static::deleting(function (MenuItem $menuItem) {
            $menuItem->children()->delete();
        });
        static::addGlobalScope('sort', function (Builder $builder) {
            return $builder->orderBy('sort_num')->orderBy('id');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id');
    }
}
