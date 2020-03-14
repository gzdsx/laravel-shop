<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\BlockItem
 *
 * @property int $id
 * @property int $block_id
 * @property string|null $title 标题
 * @property string $image 图片
 * @property string|null $url 链接
 * @property string|null $subtitle 副标题
 * @property string|null $field_1
 * @property string|null $field_2
 * @property string|null $field_3
 * @property int|null $displayorder 显示顺序
 * @property-read \App\Models\Block $block
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereUrl($value)
 * @mixin \Eloquent
 */
class BlockItem extends Model
{
    protected $table = 'block_item';
    protected $primaryKey = 'id';
    protected $fillable = ['block_id', 'title', 'image', 'url', 'subtitle', 'field_1', 'field_2', 'field_3', 'displayorder'];

    public $timestamps = false;

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
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id', 'block_id');
    }
}
