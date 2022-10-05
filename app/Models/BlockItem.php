<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\BlockItem
 *
 * @property int $id 主键
 * @property int $block_id 块ID
 * @property string|null $title 标题
 * @property string $image 图片
 * @property string|null $url 链接
 * @property string|null $subtitle 副标题
 * @property string|null $field_1
 * @property string|null $field_2
 * @property string|null $field_3
 * @property int|null $sort_num 显示顺序
 * @property-read \App\Models\Block $block
 * @method static Builder|BlockItem newModelQuery()
 * @method static Builder|BlockItem newQuery()
 * @method static Builder|BlockItem query()
 * @method static Builder|BlockItem whereBlockId($value)
 * @method static Builder|BlockItem whereField1($value)
 * @method static Builder|BlockItem whereField2($value)
 * @method static Builder|BlockItem whereField3($value)
 * @method static Builder|BlockItem whereId($value)
 * @method static Builder|BlockItem whereImage($value)
 * @method static Builder|BlockItem whereSortNum($value)
 * @method static Builder|BlockItem whereSubtitle($value)
 * @method static Builder|BlockItem whereTitle($value)
 * @method static Builder|BlockItem whereUrl($value)
 * @mixin \Eloquent
 */
class BlockItem extends Model
{
    use HasImageAttribute;

    protected $table = 'block_item';
    protected $primaryKey = 'id';
    protected $fillable = ['block_id', 'title', 'image', 'url', 'subtitle', 'field_1', 'field_2', 'field_3', 'sort_num'];
    protected $hidden = ['block_id'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('sort', function (Builder $builder) {
            return $builder->orderByDesc('sort_num')->orderBy('id');
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id', 'id');
    }
}
