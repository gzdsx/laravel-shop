<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomProductContent
 *
 * @property int $itemid 产品ID
 * @property string|null $content 产品详情
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent whereItemid($value)
 * @mixin \Eloquent
 */
class EcomProductContent extends Model
{
    protected $table = 'ecom_product_content';
    protected $primaryKey = 'itemid';
    protected $fillable = ['itemid', 'content'];
    protected $hidden = ['itemid'];

    public $timestamps = false;
}
