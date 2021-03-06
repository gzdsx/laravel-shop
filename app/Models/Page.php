<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Page
 *
 * @property int $id 主键
 * @property int $catid 分类ID
 * @property string|null $title 标题
 * @property string|null $alias 别名
 * @property string $image 图片
 * @property string|null $content 内容
 * @property string|null $template 模板
 * @property int $displayorder 排序
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\PageCategory $category
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereAlias($value)
 * @method static Builder|Page whereCatid($value)
 * @method static Builder|Page whereContent($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereDisplayorder($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereImage($value)
 * @method static Builder|Page whereTemplate($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    use HasDates, HasImageAttribute;

    protected $table = 'page';
    protected $primaryKey = 'id';
    protected $fillable = [
        'catid', 'title', 'alias', 'image', 'digest', 'content', 'template', 'displayorder'
    ];
    protected $appends = ['url', 'm_url'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('sort', function (Builder $builder) {
            return $builder->orderBy('displayorder')->orderBy('id');
        });
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->id ? url('page/' . $this->id . '.html') : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getMUrlAttribute()
    {
        return $this->id ? url('h5/page/' . $this->id . '.html') : null;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PageCategory::class, 'catid', 'catid');
    }
}
