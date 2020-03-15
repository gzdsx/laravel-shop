<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Album
 *
 * @property int $albumid
 * @property int $uid
 * @property string|null $title
 * @property string $cover
 * @property string|null $password
 * @property int $is_open
 * @property int $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Material[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereAlbumid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereViews($value)
 * @mixin \Eloquent
 */
class Album extends Model
{
    protected $table = 'album';
    protected $primaryKey = 'albumid';
    protected $fillable = ['albumid', 'uid', 'title', 'cover', 'password', 'is_open', 'views', 'created_at', 'updated_at'];

    /**
     * @param $value
     * @return string
     */
    public function getCoverAttribute($value)
    {
        return image_url($value);
    }

    /**
     * @param $value
     */
    public function setCoverAttribute($value)
    {
        $this->attributes['cover'] = str_replace(material_url(), '', $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Material::class, 'albumid', 'albumid');
    }
}
