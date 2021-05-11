<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostMedia
 *
 * @property int $id 主键
 * @property int $aid 文章ID
 * @property string|null $media_id 媒体ID
 * @property string|null $media_from 来源
 * @property string|null $media_title 标题
 * @property string $media_thumb 缩略图
 * @property string|null $media_player 播放器
 * @property string|null $media_link 链接
 * @property string|null $media_tags 标签
 * @property string|null $media_description 说明
 * @property string|null $media_source 源地址
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaTitle($value)
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
