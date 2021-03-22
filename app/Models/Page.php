<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Pages
 *
 * @property int $pageid
 * @property string $type
 * @property int $catid
 * @property string|null $title
 * @property string|null $alias
 * @property string|null $image
 * @property string|null $summary
 * @property string|null $content
 * @property string|null $template
 * @property int $displayorder
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Page $category
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|Page[] $pages
 * @property-read int|null $pages_count
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page onlyCategory()
 * @method static Builder|Page onlyPage()
 * @method static Builder|Page query()
 * @method static Builder|Page whereAlias($value)
 * @method static Builder|Page whereCatid($value)
 * @method static Builder|Page whereContent($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereDisplayorder($value)
 * @method static Builder|Page whereImage($value)
 * @method static Builder|Page wherePageid($value)
 * @method static Builder|Page whereSummary($value)
 * @method static Builder|Page whereTemplate($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereType($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'pageid';
    protected $fillable = [
        'type', 'catid', 'title', 'alias', 'image', 'summary', 'content', 'template', 'displayorder'
    ];
    protected $appends = ['url', 'h5_url'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->pageid ? url('page/' . $this->pageid . '.html') : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getH5UrlAttribute()
    {
        return $this->pageid ? url('h5/page/' . $this->pageid . '.html') : null;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Page::class, 'catid', 'pageid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'catid', 'pageid');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOnlyCategory(Builder $query)
    {
        return $query->where('type', 'category');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOnlyPage(Builder $query)
    {
        return $query->where('type', 'page');
    }
}
