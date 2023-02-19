<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomCartShop
 *
 * @property int $id 主键
 * @property int $uid 管理用户
 * @property int $shop_id 店铺ID
 * @property string|null $shop_name 店铺名称
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomCart[] $cartProducts
 * @property-read int|null $cart_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomShop[] $shop
 * @property-read int|null $shop_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCartShop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EcomCartShop extends Model
{
    use HasDates;

    protected $table = 'ecom_cart_shop';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'shop_id', 'shop_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shop()
    {
        return $this->belongsToMany(EcomShop::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartProducts()
    {
        return $this->hasMany(EcomCart::class, 'shop_id', 'shop_id');
    }
}
