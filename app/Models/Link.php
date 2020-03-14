<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Link
 *
 * @property int $id
 * @property int $catid
 * @property string $type
 * @property string|null $title
 * @property string|null $url
 * @property string $image
 * @property string|null $description
 * @property int $displayorder
 * @property-read \App\Models\Link $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Link[] $links
 * @property-read int|null $links_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link onlyLink()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereUrl($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    protected $table = 'link';
    protected $primaryKey = 'id';
    protected $fillable = ['catid', 'type', 'title', 'url', 'image', 'description', 'displayorder'];

    public $timestamps = false;

    /**
     * @param $value
     */
    public function setDisplayorderAttribute($value)
    {
        $this->attributes['displayorder'] = intval($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return image_url($value);
    }

    /**
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = str_replace(material_url(), '', $value);
    }

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
