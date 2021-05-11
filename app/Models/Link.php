<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Link
 *
 * @property int $id 主键
 * @property int $catid 分类ID
 * @property string $type 类型
 * @property string|null $title 名称
 * @property string|null $url URL
 * @property string $image 图片
 * @property string|null $description 描述
 * @property int $displayorder 显示顺序
 * @property-read Link $category
 * @property-read \Illuminate\Database\Eloquent\Collection|Link[] $links
 * @property-read int|null $links_count
 * @method static Builder|Link newModelQuery()
 * @method static Builder|Link newQuery()
 * @method static Builder|Link onlyCategory()
 * @method static Builder|Link onlyLink()
 * @method static Builder|Link query()
 * @method static Builder|Link whereCatid($value)
 * @method static Builder|Link whereDescription($value)
 * @method static Builder|Link whereDisplayorder($value)
 * @method static Builder|Link whereId($value)
 * @method static Builder|Link whereImage($value)
 * @method static Builder|Link whereTitle($value)
 * @method static Builder|Link whereType($value)
 * @method static Builder|Link whereUrl($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    use HasImageAttribute;

    protected $table = 'link';
    protected $primaryKey = 'id';
    protected $fillable = ['catid', 'type', 'title', 'url', 'image', 'description', 'displayorder'];
    protected $casts = [
        'displayorder' => 'integer'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany(Link::class, 'catid', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Link::class, 'catid', 'id');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeOnlyCategory(Builder $builder)
    {
        return $builder->where('type', 'category');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeOnlyLink(Builder $builder)
    {
        return $builder->where('type', 'item');
    }
}
