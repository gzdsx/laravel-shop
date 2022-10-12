<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PostImage
 *
 * @property int $id
 * @property int $aid 数据ID
 * @property string $thumb
 * @property string $image
 * @property int $isremote
 * @property string|null $description
 * @property int $displayorder
 * @property-read \App\Models\PostItem|null $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereIsremote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereThumb($value)
 * @mixin \Eloquent
 */
class PostImage extends Model
{
    use HasThumbAttribute, HasImageAttribute;

    protected $table = 'post_image';
    protected $primaryKey = 'id';
    protected $fillable = ['aid', 'thumb', 'image', 'description', 'displayorder'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(PostItem::class, 'aid', 'aid');
    }
}
