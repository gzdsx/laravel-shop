<?php

namespace App\Models;

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
 * @property-read \App\Models\Pages $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pages[] $pages
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages onlyPage()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages wherePageid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pages extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'pageid';
    protected $fillable = [
        'type', 'catid', 'title', 'alias', 'image', 'summary',
        'content', 'template', 'displayorder', 'created_at', 'updated_at'
    ];
    protected $appends = ['url', 'h5_url'];

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return url('pages/detail/' . $this->attributes['pageid'] . '.html');
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getH5UrlAttribute()
    {
        return url('h5/pages/detail/' . $this->attributes['pageid'] . '.html');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Pages::class, 'catid', 'pageid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Pages::class, 'catid', 'pageid');
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
