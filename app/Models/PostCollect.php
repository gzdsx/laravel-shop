<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostCollect
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $aid 文章ID
 * @property string|null $title 文章标题
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $url
 * @property-read \App\Models\PostItem $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostCollect extends Model
{
    use HasDates;

    protected $table = 'post_collect';
    protected $primaryKey = 'id';
    protected $fillable = ['aid', 'uid', 'title'];
    protected $appends = ['url'];

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
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getUrlAttribute()
    {
        return $this->aid ? url('post/' . $this->aid . '.html') : null;
    }
}
