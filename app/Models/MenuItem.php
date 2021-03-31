<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int $fid
 * @property string|null $title
 * @property string|null $url
 * @property string $image
 * @property string $target
 * @property int $displayorder
 * @property int $available
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
