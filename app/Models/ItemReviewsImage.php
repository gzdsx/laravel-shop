<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ItemReviewsImage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemReviewsImage query()
 * @mixin \Eloquent
 */
class ItemReviewsImage extends Model
{
    protected $table = 'item_reviews_image';
    protected $primaryKey = 'id';

    public $timestamps = false;

}
