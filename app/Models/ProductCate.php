<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductCate
 *
 * @property int $id
 * @property int|null $itemid
 * @property int|null $catid
 * @property-read \App\Models\ProductCategory|null $catlog
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate whereItemid($value)
 * @mixin \Eloquent
 */
class ProductCate extends Model
{
    protected $table = 'product_cate';
    protected $fillable = ['itemid', 'catid'];
    public $timestamps = false;

    public function catlog()
    {
        return $this->belongsTo(ProductCategory::class, 'catid', 'catid');
    }
}
