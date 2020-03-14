<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostImage
 *
 * @property int $id
 * @property int $aid 数据ID
 * @property string $image
 * @property string $thumb
 * @property int $isremote
 * @property string|null $description
 * @property int $displayorder
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereIsremote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereThumb($value)
 * @mixin \Eloquent
 */
class PostImage extends Model
{
    protected $table = 'post_image';
    protected $primaryKey = 'id';
    protected $fillable = ['aid', 'thumb', 'image', 'description', 'displayorder'];

    public $timestamps = false;

    /**
     * @param $value
     * @return string
     */
    public function getThumbAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setThumbAttribute($value)
    {
        $this->attributes['thumb'] = strip_image_url($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = strip_image_url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }
}
