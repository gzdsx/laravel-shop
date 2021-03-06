<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\ProductContent
 *
 * @property int $itemid 产品ID
 * @property string|null $content 内容
 * @property-read \App\Models\ProductItem $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent whereItemid($value)
 * @mixin \Eloquent
 */
class ProductContent extends Model
{
    protected $table = 'product_content';
    protected $primaryKey = 'itemid';
    protected $fillable = ['itemid', 'content'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductItem::class, 'itemid', 'itemid');
    }
}
