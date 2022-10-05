<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomProductProps
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps query()
 * @mixin \Eloquent
 */
class ProductProps extends Model
{
    protected $table = 'ecom_product_props';
    protected $primaryKey = 'id';
    protected $fillable = ['itemid', 'prop_id', 'prop_name', 'prop_value'];

    public $timestamps = false;
}
