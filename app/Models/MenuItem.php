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
 * @property int $fid 父级ID
 * @property string|null $title 标题
 * @property string|null $url 链接
 * @property string $image 图片
 * @property string $target 目标
 * @property int $displayorder 显示顺序
 * @property int $available 是否可用
 * @property-read \Illuminate\Database\Eloquent\Collection|MenuItem[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Menu $menu
 * @property-read MenuItem $parent
 * @method static Builder|MenuItem newModelQuery()
 * @method static Builder|MenuItem newQuery()
 * @method static Builder|MenuItem query()
 * @method static Builder|MenuItem whereAvailable($value)
 * @method static Builder|MenuItem whereDisplayorder($value)
 * @method static Builder|MenuItem whereFid($value)
 * @method static Builder|MenuItem whereId($value)
 * @method static Builder|MenuItem whereImage($value)
 * @method static Builder|MenuItem whereMenuId($value)
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
    protected $fillable = ['title', 'menu_id', 'fid', 'url', 'image', 'target', 'displayorder', 'available'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();;
        static::deleting(function (MenuItem $menuItem) {
            $menuItem->children()->delete();
        });
        static::addGlobalScope('sort', function (Builder $builder) {
            return $builder->orderBy('displayorder')->orderBy('id');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'fid', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'fid', 'id');
    }
}
