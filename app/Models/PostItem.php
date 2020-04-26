<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\PostItem
 *
 * @property int $aid 文章ID
 * @property int $uid 会员ID
 * @property int $catid 分类ID
 * @property string|null $author 作者
 * @property string|null $type 文章形式
 * @property string|null $title 文章标题
 * @property string|null $alias 别名
 * @property string|null $summary 摘要
 * @property string $image 图片
 * @property array|null $tags 标签
 * @property int $allowcomment 允许评论
 * @property int $collections 被收藏数
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $comments 评论数
 * @property int $views 浏览数
 * @property int $likes 点赞数
 * @property int $state 0：待审,1:已审核,-1:审核不过
 * @property string|null $from 来源
 * @property string|null $fromurl 来源地址
 * @property int $contents 内容数
 * @property float $price 阅读价格
 * @property int $click1
 * @property int $click2
 * @property int $click3
 * @property int $click4
 * @property int $click5
 * @property int $click6
 * @property int $click7
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostCatlog $catlog
 * @property-read int|null $comments_count
 * @property-read \App\Models\PostContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read mixed $state_des
 * @property-read mixed $type_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\PostMedia|null $media
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAllowcomment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFromurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereViews($value)
 * @mixin \Eloquent
 */
class PostItem extends Model
{
    use Filterable;

    protected $table = 'post_item';
    protected $primaryKey = 'aid';
    protected $casts = [
        'tags' => 'array'
    ];
    protected $appends = [
        'type_des',
        'state_des',
        'url',
        'h5_url'
    ];
    protected $fillable = [
        'uid', 'catid', 'author', 'type', 'title', 'alias', 'summary', 'image', 'price',
        'tag', 'allowcomment', 'views', 'state', 'from', 'fromurl', 'created_at', 'updated_at'
    ];
    protected $with = ['user','catlog'];

    /**
     * PostItem constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $attributes = array_merge([
            'uid' => Auth::id(),
            'price' => '0',
            'from' => env('APP_NAME'),
            'fromurl' => env('APP_URL'),
            'summary' => '',
            'type' => 'article',
            'state' => '1',
            'author' => '',
            'created_at' => now(),
            'allowcomment' => 1
        ], $attributes);
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (PostItem $postItem) {
            $postItem->uid = Auth::id();
        });

        static::created(function (PostItem $postItem) {
            $postItem->content()->create();
        });

        static::deleted(function (PostItem $postItem) {
            $postItem->content()->delete();
            $postItem->comments()->delete();
            $postItem->media()->delete();
            $postItem->images()->delete();
            $postItem->logs()->delete();
        });

        static::addGlobalScope('available', function (Builder $builder) {
            return $builder->where('state', 1);
        });
    }

    /**
     * @return mixed
     */
    public function getTypeDesAttribute()
    {
        return $this->type ? __('post.post_types.' . $this->type) : null;
    }

    /**
     * @return mixed
     */
    public function getStateDesAttribute()
    {
        return is_numeric($this->state) ? __('post.post_states.' . $this->state) : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->aid ? url('post/detail/' . $this->aid . '.html') : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getH5UrlAttribute()
    {
        return $this->aid ? url('h5/post/detail/' . $this->attributes['aid'] . '.html') : null;
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
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catlog()
    {
        return $this->belongsTo(PostCatlog::class, 'catid', 'catid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
        return $this->hasOne(PostContent::class, 'aid', 'aid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function media()
    {
        return $this->hasOne(PostMedia::class, 'aid', 'aid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(PostImage::class, 'aid', 'aid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'aid', 'aid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(PostLog::class, 'aid', 'aid');
    }
}
