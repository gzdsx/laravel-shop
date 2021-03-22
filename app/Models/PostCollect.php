<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $aid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostItem|null $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostCollect extends Model
{
    protected $table = 'post_collect';
    protected $primaryKey = 'id';
    protected $fillable = ['aid', 'uid'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(PostItem::class, 'aid', 'aid');
    }
}
