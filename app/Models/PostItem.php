<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasMetas;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\PostItem
 *
 * @property int $id 文章ID
 * @property int $user_id 会员ID
 * @property string|null $author 作者
 * @property string|null $format 文章格式
 * @property string|null $type 文章类型
 * @property string|null $title 文章标题
 * @property string|null $alias 别名
 * @property string|null $excerpt 摘要
 * @property string $image 图片
 * @property array|null $tags 标签
 * @property int $allow_comment 允许评论
 * @property int $comment_num 评论数
 * @property int $collect_num 被收藏数
 * @property int $like_num 点赞数
 * @property int $views 浏览数
 * @property string|null $from 来源
 * @property string|null $fromurl 来源地址
 * @property float $price 阅读价格
 * @property int $click1
 * @property int $click2
 * @property int $click3
 * @property int $click4
 * @property int $click5
 * @property int $click6
 * @property int $click7
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $collectedUsers
 * @property-read int|null $collected_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostComment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\PostContent|null $content
 * @property-read mixed $format_des
 * @property-read mixed $status_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostImage> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostLog> $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\PostMedia|null $media
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostMeta> $metas
 * @property-read int|null $metas_count
 * @property-read \App\Models\User|null $user
 * @method static Builder|PostItem filter(array $input = [], $filter = null)
 * @method static Builder|PostItem newModelQuery()
 * @method static Builder|PostItem newQuery()
 * @method static Builder|PostItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|PostItem query()
 * @method static Builder|PostItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|PostItem whereAlias($value)
 * @method static Builder|PostItem whereAllowComment($value)
 * @method static Builder|PostItem whereAuthor($value)
 * @method static Builder|PostItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|PostItem whereClick1($value)
 * @method static Builder|PostItem whereClick2($value)
 * @method static Builder|PostItem whereClick3($value)
 * @method static Builder|PostItem whereClick4($value)
 * @method static Builder|PostItem whereClick5($value)
 * @method static Builder|PostItem whereClick6($value)
 * @method static Builder|PostItem whereClick7($value)
 * @method static Builder|PostItem whereCollectNum($value)
 * @method static Builder|PostItem whereCommentNum($value)
 * @method static Builder|PostItem whereCreatedAt($value)
 * @method static Builder|PostItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|PostItem whereExcerpt($value)
 * @method static Builder|PostItem whereFormat($value)
 * @method static Builder|PostItem whereFrom($value)
 * @method static Builder|PostItem whereFromurl($value)
 * @method static Builder|PostItem whereId($value)
 * @method static Builder|PostItem whereImage($value)
 * @method static Builder|PostItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|PostItem whereLikeNum($value)
 * @method static Builder|PostItem wherePrice($value)
 * @method static Builder|PostItem whereStatus($value)
 * @method static Builder|PostItem whereTags($value)
 * @method static Builder|PostItem whereTitle($value)
 * @method static Builder|PostItem whereType($value)
 * @method static Builder|PostItem whereUpdatedAt($value)
 * @method static Builder|PostItem whereUserId($value)
 * @method static Builder|PostItem whereViews($value)
 * @mixin \Eloquent
 */
class PostItem extends Model
{
    use Filterable, HasImageAttribute, HasDates, HasMetas;

    const STATUS_PUBLISH = 'publish';
    const STATUS_DRAFT = 'draft';
    const STATUS_INHERIT = 'inherit';

    protected $table = 'post_item';
    protected $primaryKey = 'id';
    protected $casts = [
        'tags' => 'array'
    ];
    protected $appends = [
        'format_des',
        'status_des',
        'url',
    ];
    protected $fillable = [
        'id', 'user_id', 'author', 'format', 'type', 'title', 'alias', 'excerpt', 'image', 'tags',
        'allow_comment', 'collection_num', 'comment_num', 'like_num', 'views', 'status', 'from', 'fromurl',
        'price', 'click1', 'click2', 'click3', 'click4', 'click5', 'click6', 'click7', 'created_at', 'updated_at'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (PostItem $postItem) {
            if (!$postItem->user_id) {
                $postItem->user_id = Auth::id();
            }
        });

        static::created(function (PostItem $postItem) {
            $postItem->content()->create();
        });

        static::deleting(function (PostItem $postItem) {
            $postItem->content()->delete();
            $postItem->media()->delete();
            $postItem->images()->delete();
            $postItem->logs()->delete();
            $postItem->comments()->delete();
        });
    }

    /**
     * @return mixed
     */
    public function getFormatDesAttribute()
    {
        return $this->format ? trans('post.formats.' . $this->format) : null;
    }

    /**
     * @return mixed
     */
    public function getStatusDesAttribute()
    {
        return $this->status ? trans('post.statuses.' . $this->status) : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->id ? url('post/' . $this->id . '.html') : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Category
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'post_category',
            'post_id',
            'post_cate_id',
            'id',
            'cate_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|PostContent
     */
    public function content()
    {
        return $this->hasOne(PostContent::class, 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function media()
    {
        return $this->hasOne(PostMedia::class, 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(PostLog::class, 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|User
     */
    public function collectedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'post_collect',
            'post_id',
            'user_id',
            'id',
            'uid'
        )->as('subscribe')->withTimestamps()->orderBy('post_collect.created_at', 'desc');;
    }

    public function metas()
    {
        return $this->hasMany(PostMeta::class, 'post_id', 'id');
    }

    public function incrementViews($amount = 1)
    {
        return $this->increment('views', $amount);
    }
}
