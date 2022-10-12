<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EcomShopSession
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $shop_id 店铺ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopSession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EcomShopSession extends Model
{
    use HasDates;

    protected $table = 'ecom_shop_session';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'shop_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }
}
