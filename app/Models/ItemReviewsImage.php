<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemReviewsImage
 *
 * @property int $id
 * @property int $review_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage whereThumb($value)
 * @mixin \Eloquent
 */
class ItemReviewsImage extends Model
{
    protected $table = 'item_reviews_image';
    protected $primaryKey = 'id';
    protected $fillable = ['review_id', 'thumb', 'image'];

    public $timestamps = false;

    /**
     * @param $value
     * @return string
     */
    public function getThumbAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setThumbAttribute($value)
    {
        $this->attributes['thumb'] = strip_image_url($value);
    }

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
}
