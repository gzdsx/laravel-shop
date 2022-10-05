<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\EcomProductClassify
 *
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClassify query()
 * @mixin \Eloquent
 */
class ProductClassify extends Model
{
    protected $table = 'ecom_product_classify';
    protected $primaryKey = 'cate_id';
    protected $fillable = ['cate_name', 'shop_id', 'parent_id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }
}
