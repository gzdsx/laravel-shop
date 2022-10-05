<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShopSession
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $shop_id 店铺ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop $shop
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopSession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopSession extends Model
{
    use HasDates;

    protected $table = 'shop_session';
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
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }
}
