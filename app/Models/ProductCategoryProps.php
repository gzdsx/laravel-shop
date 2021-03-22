<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductCategoryProps
 *
 * @property int $prop_id
 * @property int $catid
 * @property string|null $title
 * @property string|null $type
 * @property int $required
 * @property string|null $default
 * @property string|null $options
 * @property string|null $rules
 * @property-read \App\Models\ProductCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategoryProps whereType($value)
 * @mixin \Eloquent
 */
class ProductCategoryProps extends Model
{
    protected $table = 'product_category_props';
    protected $primaryKey = 'prop_id';
    protected $fillable = ['catid', 'title', 'type', 'required', 'default', 'options', 'rules'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'catid', 'catid');
    }
}
