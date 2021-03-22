<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostContent
 *
 * @property int $aid
 * @property string|null $content
 * @property int $pageorder
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent wherePageorder($value)
 * @mixin \Eloquent
 */
class PostContent extends Model
{
    protected $table = 'post_content';
    protected $primaryKey = 'aid';
    protected $fillable = ['aid', 'content'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }
}
