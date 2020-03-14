<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostMedia
 *
 * @property int $id
 * @property int $aid
 * @property string|null $media_id
 * @property string|null $media_from
 * @property string|null $media_title
 * @property string $media_thumb
 * @property string|null $media_player
 * @property string|null $media_link
 * @property string|null $media_tags
 * @property string|null $media_description
 * @property string|null $media_source
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaTitle($value)
 * @mixin \Eloquent
 */
class PostMedia extends Model
{
    protected $table = 'post_media';
    protected $primaryKey = 'id';
    protected $fillable = [
        'aid', 'media_id', 'media_from', 'media_title', 'media_thumb',
        'media_player', 'media_link', 'media_tags', 'media_description', 'media_source'
    ];

    public $timestamps = false;

    /**
     * @param $value
     * @return string
     */
    public function getMediaThumbAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setMediaThumbAttribute($value)
    {
        $this->attributes['media_thumb'] = strip_image_url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }
}
