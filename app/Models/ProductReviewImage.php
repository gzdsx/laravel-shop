<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductReviewImage
 *
 * @property int $id 主键
 * @property int $review_id 评价ID
 * @property string $thumb 小图
 * @property string $image 大图
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereThumb($value)
 * @mixin \Eloquent
 */
class ProductReviewImage extends Model
{
    use HasThumbAttribute, HasImageAttribute;

    protected $table = 'product_review_image';
    protected $primaryKey = 'id';
    protected $fillable = ['review_id', 'thumb', 'image'];

    public $timestamps = false;
}
