<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RefundReason
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason whereTitle($value)
 * @mixin \Eloquent
 */
class RefundReason extends Model
{
    protected $table = 'refund_reason';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'displayorder'];

    public $timestamps = false;

    /**
     * @param $value
     */
    public function setDisplayorderAttribute($value)
    {
        $this->attributes['displayorder'] = intval($value);
    }
}
