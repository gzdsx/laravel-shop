<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\PostItem
 *
 * @property int $aid 文章ID
 * @property int $uid 会员ID
 * @property int $cate_id 分类ID
 * @property string|null $author 作者
 * @property string|null $type 文章形式
 * @property string|null $title 文章标题
 * @property string|null $alias 别名
 * @property string|null $summary 摘要
 * @property string $image 图片
 * @property array|null $tags 标签
 * @property int $allowcomment 允许评论
 * @property int $collect_count 被收藏数
 * @property int $comment_count 评论数
 * @property int $like_count 点赞数
 * @property int $views 浏览数
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
 * @property int $state 0：待审,1:已审核,-1:审核不过
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $collectedUsers
 * @property-read int|null $collected_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\PostContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read mixed $state_des
 * @property-read mixed $type_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\PostMedia|null $media
 * @property-read \App\Models\User|null $user
 * @method static Builder|PostItem filter(array $input = [], $filter = null)
 * @method static Builder|PostItem newModelQuery()
 * @method static Builder|PostItem newQuery()
 * @method static Builder|PostItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|PostItem query()
 * @method static Builder|PostItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|PostItem whereAid($value)
 * @method static Builder|PostItem whereAlias($value)
 * @method static Builder|PostItem whereAllowcomment($value)
 * @method static Builder|PostItem whereAuthor($value)
 * @method static Builder|PostItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|PostItem whereCateId($value)
 * @method static Builder|PostItem whereClick1($value)
 * @method static Builder|PostItem whereClick2($value)
 * @method static Builder|PostItem whereClick3($value)
 * @method static Builder|PostItem whereClick4($value)
 * @method static Builder|PostItem whereClick5($value)
 * @method static Builder|PostItem whereClick6($value)
 * @method static Builder|PostItem whereClick7($value)
 * @method static Builder|PostItem whereCollectCount($value)
 * @method static Builder|PostItem whereCommentCount($value)
 * @method static Builder|PostItem whereContents($value)
 * @method static Builder|PostItem whereCreatedAt($value)
 * @method static Builder|PostItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|PostItem whereFrom($value)
 * @method static Builder|PostItem whereFromurl($value)
 * @method static Builder|PostItem whereImage($value)
 * @method static Builder|PostItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|PostItem whereLikeCount($value)
 * @method static Builder|PostItem wherePrice($value)
 * @method static Builder|PostItem whereState($value)
 * @method static Builder|PostItem whereSummary($value)
 * @method static Builder|PostItem whereTags($value)
 * @method static Builder|PostItem whereTitle($value)
 * @method static Builder|PostItem whereType($value)
 * @method static Builder|PostItem whereUid($value)
 * @method static Builder|PostItem whereUpdatedAt($value)
 * @method static Builder|PostItem whereViews($value)
 * @mixin \Eloquent
 */
class PostItem extends Model
{
    use Filterable, HasImageAttribute, HasDates;

    protected $table = 'post_item';
    protected $primaryKey = 'aid';
    protected $casts = [
        'tags' => 'array'
    ];
    protected $appends = [
        'type_des',
        'state_des',
        'url',
        'm_url'
    ];
    protected $fillable = [
        'aid', 'uid', 'cate_id', 'author', 'type', 'title', 'alias', 'summary', 'image', 'tags',
        'allowcomment', 'collection_count', 'comment_count', 'like_count', 'views', 'state', 'from', 'fromurl',
        'contents', 'price', 'click1', 'click2', 'click3', 'click4', 'click5', 'click6', 'click7', 'created_at', 'updated_at'
    ];
    protected $with = ['user', 'category'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (PostItem $postItem) {
            if (!$postItem->uid) {
                $postItem->uid = Auth::id();
            }
        });

        static::created(function (PostItem $postItem) {
            $postItem->content()->create();
        });

        static::deleting(function (PostItem $postItem) {
            $postItem->content()->delete();
            $postItem->comments()->delete();
            $postItem->media()->delete();
            $postItem->images()->delete();
            $postItem->logs()->delete();
        });
    }

    /**
     * @return mixed
     */
    public function getTypeDesAttribute()
    {
        return $this->type ? trans('post.type_options.' . $this->type) : null;
    }

    /**
     * @return mixed
     */
    public function getStateDesAttribute()
    {
        return is_numeric($this->state) ? trans('post.state_options.' . $this->state) : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->aid ? url('post/' . $this->aid . '.html') : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getMUrlAttribute()
    {
        return $this->aid ? url('h5/post/' . $this->aid . '.html') : null;
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
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'cate_id', 'cate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|PostContent
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|User
     */
    public function collectedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'post_collect_user',
            'collect_aid',
            'collect_uid',
            'aid',
            'uid'
        )->as('subscribe')->withTimestamps()->orderBy('post_collect_user.created_at', 'desc');;
    }
}
