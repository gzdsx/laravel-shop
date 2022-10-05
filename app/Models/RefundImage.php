<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\RefundImage
 *
 * @property int $id
 * @property int $refund_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereThumb($value)
 * @mixin \Eloquent
 */
class RefundImage extends Model
{
    use HasImageAttribute, HasThumbAttribute;

    protected $table = 'refund_image';
    protected $primaryKey = 'id';
    protected $fillable = ['refund_id', 'thumb', 'image'];
    public $timestamps = false;
}
