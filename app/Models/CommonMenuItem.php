<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommonMenuItem
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
 * @property-read \Illuminate\Database\Eloquent\Collection|CommonMenuItem[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\CommonMenu|null $menu
 * @property-read CommonMenuItem|null $parent
 * @method static Builder|CommonMenuItem newModelQuery()
 * @method static Builder|CommonMenuItem newQuery()
 * @method static Builder|CommonMenuItem query()
 * @method static Builder|CommonMenuItem whereHide($value)
 * @method static Builder|CommonMenuItem whereId($value)
 * @method static Builder|CommonMenuItem whereImage($value)
 * @method static Builder|CommonMenuItem whereMenuId($value)
 * @method static Builder|CommonMenuItem whereParentId($value)
 * @method static Builder|CommonMenuItem whereSortNum($value)
 * @method static Builder|CommonMenuItem whereTarget($value)
 * @method static Builder|CommonMenuItem whereTitle($value)
 * @method static Builder|CommonMenuItem whereUrl($value)
 * @mixin \Eloquent
 */
class CommonMenuItem extends Model
{
    use HasImageAttribute;

    protected $table = 'common_menu_item';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'menu_id', 'parent_id', 'url', 'image', 'target', 'hide', 'sort_num'];
    protected $hidden = ['menu_id'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();;
        static::deleting(function (CommonMenuItem $menuItem) {
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
        return $this->belongsTo(CommonMenu::class, 'menu_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(CommonMenuItem::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(CommonMenuItem::class, 'parent_id', 'id');
    }
}
