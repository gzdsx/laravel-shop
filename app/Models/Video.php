<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video
 *
 * @property int $id 主键
 * @property string|null $title 标题
 * @property string $image 封面图
 * @property string|null $content 内容
 * @property string|null $source 源地址
 * @property string|null $link 链接
 * @property int $views 浏览数
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $m_url
 * @property-read mixed $player
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereViews($value)
 * @mixin \Eloquent
 */
class Video extends Model
{
    use HasImageAttribute, HasDates;

    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content', 'image', 'link', 'views', 'source'];
    protected $appends = ['player', 'url', 'm_url'];


    public function getPlayerAttribute()
    {
        $url = $this->link;
        preg_match('/(youku\.com|v\.qq\.com)/', strtolower($url), $matches);
        if (isset($matches[1])) {
            if ($matches[1] == 'youku.com') {
                preg_match('/id\_(\w+)[\=|\.html]/', $url, $urls);
                return '<iframe src="https://player.youku.com/embed/' . $urls[1] . '" frameborder="0" webkit-playsinline playsinline x5-playsinline x-webkit-airplay="allow" allowfullscreen></iframe>';
            }

            if ($matches[1] == 'v.qq.com') {
                preg_match('/\/([a-zA-Z0-9]+)\.html/', $url, $urls);
                return '<iframe frameborder="0" src="https://v.qq.com/txp/iframe/player.html?vid=' . $urls[1] . '" webkit-playsinline playsinline x5-playsinline x-webkit-airplay="allow" allowFullScreen="true"></iframe>';
            }

            return null;
        }

        return null;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getUrlAttribute()
    {
        return $this->id ? url('video/' . $this->id . '.html') : null;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getMUrlAttribute()
    {
        return $this->id ? url('h5/video/' . $this->id . '.html') : null;
    }
}
