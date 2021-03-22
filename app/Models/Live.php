<?php

namespace App\Models;


use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Live
 *
 * @property int $id
 * @property int|null $uid 用户
 * @property int $channel_id 频道
 * @property string|null $stream_id 直播流ID
 * @property string|null $title 话题
 * @property string $image 海报
 * @property string|null $video_id 录制视频ID
 * @property string|null $video_url 录制视频地址
 * @property string|null $content 直播介绍
 * @property int $id_position ID显示位置
 * @property int $watch_mode 观看方式
 * @property string $price 观看价格
 * @property int $state 状态
 * @property int $views 浏览量
 * @property \Illuminate\Support\Carbon|null $start_at 开始时间
 * @property \Illuminate\Support\Carbon|null $expires_at 过期时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyLog[] $buyLogs
 * @property-read int|null $buy_logs_count
 * @property-read \App\Models\LiveChannel $channel
 * @property-read string|null $flv
 * @property-read string|null $hls
 * @property-read string|null $hls_hd
 * @property-read string|null $hls_low
 * @property-read string|null $hls_play_url
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $m_url
 * @property-read \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed $obs_push_url
 * @property-read string|null $obs_stream_name
 * @property-read string|null $push_url
 * @property-read mixed $state_des
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $url
 * @property-read \App\Models\User|null $user
 * @method static Builder|Live filter(array $input = [], $filter = null)
 * @method static Builder|Live newModelQuery()
 * @method static Builder|Live newQuery()
 * @method static Builder|Live paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Live query()
 * @method static Builder|Live simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|Live whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Live whereChannelId($value)
 * @method static Builder|Live whereContent($value)
 * @method static Builder|Live whereCreatedAt($value)
 * @method static Builder|Live whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Live whereExpiresAt($value)
 * @method static Builder|Live whereId($value)
 * @method static Builder|Live whereIdPosition($value)
 * @method static Builder|Live whereImage($value)
 * @method static Builder|Live whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Live wherePrice($value)
 * @method static Builder|Live whereStartAt($value)
 * @method static Builder|Live whereState($value)
 * @method static Builder|Live whereStreamId($value)
 * @method static Builder|Live whereTitle($value)
 * @method static Builder|Live whereUid($value)
 * @method static Builder|Live whereUpdatedAt($value)
 * @method static Builder|Live whereVideoId($value)
 * @method static Builder|Live whereVideoUrl($value)
 * @method static Builder|Live whereViews($value)
 * @method static Builder|Live whereWatchMode($value)
 * @mixin \Eloquent
 */
class Live extends Model
{
    use Filterable;

    protected $table = 'live';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'channel_id', 'title', 'stream_id', 'state', 'watch_mode', 'price',
        'start_at', 'expires_at', 'image', 'content', 'video_id', 'video_url'
    ];
    protected $dates = ['start_at', 'expires_at'];
    protected $appends = ['push_url', 'obs_push_url', 'obs_stream_name', 'hls', 'hls_low', 'hls_hd', 'flv', 'hls_play_url', 'state_des', 'url', 'm_url'];
    protected $with = ['user', 'channel'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function (Live $live) {
            if (!$live->uid) {
                $live->uid = Auth::id();
            }

            if (!$live->stream_id) {
                $live->stream_id = uniqid();
            }
        });

        static::saving(function (Live $live) {
            $live->expires_at = $live->start_at->addSeconds(172800);
        });

        static::addGlobalScope('online', function (Builder $builder) {
            //return $builder->where('state', 1);
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
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
     * @return string|null
     */
    public function getPushUrlAttribute()
    {
        if ($this->stream_id && $this->expires_at) {
            return config('live.push_url') . '/' . $this->stream_id . '?' .
                self::makePushStr($this->stream_id, $this->expires_at->getTimestamp());
        }
        return null;
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getObsPushUrlAttribute()
    {
        return config('live.push_url');
    }

    /**
     * @return string|null
     */
    public function getObsStreamNameAttribute()
    {
        if ($this->stream_id && $this->expires_at) {
            return $this->stream_id . '?' . self::makePushStr($this->stream_id, $this->expires_at->getTimestamp());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getFlvAttribute()
    {
        if ($this->stream_id && $this->expires_at) {
            return config('live.play_url') . '/' . $this->stream_id . '.flv?' .
                self::makePlayStr($this->stream_id, $this->expires_at->getTimestamp());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getHlsAttribute()
    {
        if ($this->stream_id && $this->expires_at) {
            return config('live.play_url') . '/' . $this->stream_id . '.m3u8?' .
                self::makePlayStr($this->stream_id, $this->expires_at->getTimestamp());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getHlsLowAttribute()
    {
        if ($this->stream_id && $this->expires_at) {
            return config('live.play_url') . '/' . $this->stream_id . '_low.m3u8?' .
                self::makePlayStr($this->stream_id, $this->expires_at->getTimestamp());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getHlsHdAttribute()
    {
        if ($this->stream_id && $this->expires_at) {
            return config('live.play_url') . '/' . $this->stream_id . '_hd.m3u8?' .
                self::makePlayStr($this->stream_id, $this->expires_at->getTimestamp());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getHlsPlayUrlAttribute()
    {
        if ($this->stream_id) {
            return 'https://play.gzdsx.cn/vod/' . $this->stream_id . '/index.m3u8';
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getStateDesAttribute()
    {
        return is_numeric($this->state) ? trans('live.live_states.' . $this->state) : null;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getUrlAttribute()
    {
        return $this->id ? url('live/' . $this->id) : null;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getMUrlAttribute()
    {
        return $this->id ? url('h5/live/' . $this->id) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(LiveChannel::class, 'channel_id', 'channel_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function buyLogs()
    {
        return $this->morphMany(BuyLog::class, 'buyable');
    }

    /**
     * 创建串流秘钥
     * @param $stram_id
     * @param null $time
     * @return string
     */
    public static function makePushStr($stram_id, $time = null)
    {
        if ($stram_id && $time) {
            $txTime = strtoupper(base_convert($time, 10, 16));
            $txSecret = md5(config('live.push_key') . $stram_id . $txTime);
            $ext_str = http_build_query([
                "appid" => config('live.appid'),
                "txSecret" => $txSecret,
                "txTime" => $txTime
            ]);

            if (config('live.driver') == 'txlive') {
                $ext_str = http_build_query([
                    "txSecret" => $txSecret,
                    "txTime" => $txTime
                ]);
            } else {
                $ext_str = http_build_query([
                    "appid" => config('live.appid'),
                    "txSecret" => $txSecret,
                    "txTime" => $txTime
                ]);
            }
        }

        return (isset($ext_str) ? $ext_str : "");
    }

    /**
     * @param $stram_id
     * @param null $time
     * @return string
     */
    public static function makePlayStr($stram_id, $time = null)
    {
        if ($stram_id && $time) {
            $txTime = strtoupper(base_convert($time, 10, 16));
            $txSecret = md5(config('live.play_key') . $stram_id . $txTime);
            if (config('live.driver') == 'txlive') {
                $ext_str = http_build_query([
                    "txSecret" => $txSecret,
                    "txTime" => $txTime
                ]);
            } else {
                $ext_str = http_build_query([
                    "appid" => config('live.appid'),
                    "txSecret" => $txSecret,
                    "txTime" => $txTime
                ]);
            }
        }

        return (isset($ext_str) ? $ext_str : "");
    }
}
