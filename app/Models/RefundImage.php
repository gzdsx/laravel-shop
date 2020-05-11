<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RefundImage
 *
 * @property int $id
 * @property int $refund_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereThumb($value)
 * @mixin \Eloquent
 */
class RefundImage extends Model
{
    protected $table = 'refund_image';
    protected $primaryKey = 'id';
    protected $fillable = ['refund_id', 'thumb', 'image'];
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
