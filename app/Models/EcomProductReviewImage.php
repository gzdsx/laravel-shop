<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomProductReviewImage
 *
 * @property int $id
 * @property int $review_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereThumb($value)
 * @mixin \Eloquent
 */
class EcomProductReviewImage extends Model
{
    use HasThumbAttribute, HasImageAttribute;

    protected $table = 'ecom_product_review_image';
    protected $primaryKey = 'id';
    protected $fillable = ['review_id', 'thumb', 'image'];

    public $timestamps = false;
}
