<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\Shop
 *
 * @property int $shop_id 店铺ID
 * @property int $seller_id 店主UID
 * @property string|null $shop_name 店铺名称
 * @property int $type 店铺类型，1=总店，2=分店
 * @property string $logo 店铺标志
 * @property string|null $tel 门店电话
 * @property string|null $weixin 微信
 * @property string|null $province 所在省
 * @property string|null $city 所在市
 * @property string|null $district 所在县
 * @property string|null $street 街道
 * @property float|null $latitude 纬度
 * @property float|null $longitude 经度
 * @property int $views 浏览次数
 * @property int $collect_count 收藏数量
 * @property int $subscribe_count 关注量
 * @property int $visitors 访客数
 * @property string $turnover 营业额
 * @property int $month_sales 月销量
 * @property int $cumulative_sales 累计销量
 * @property string|null $description 店铺简介
 * @property float|null $score 评分
 * @property int $closed 已关闭
 * @property int $bond_state 缴纳保证金状态
 * @property int $auth_state 认证状态
 * @property array|null $new_products 新上产品
 * @property string|null $last_reviews 最新评价
 * @property string|null $notice 店铺公告
 * @property int $is_seven_refund 7天无理由退货
 * @property int $is_pay_reduce_stock 付款减库存
 * @property int $is_refund_rollback_stock 退货恢复库存
 * @property Carbon|null $created_at 开店时间
 * @property Carbon|null $updated_at 更新时间
 * @property-read \App\Models\ShopCertify|null $certify
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductClassify[] $classifies
 * @property-read int|null $classifies_count
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $auth_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $bond_state_des
 * @property-read string $formatted_address
 * @property-read string $state_des
 * @property-read string|null $we_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ShopImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductAttr[] $productAttrs
 * @property-read int|null $product_attrs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $seller
 * @property-read \App\Models\ShopStats|null $stats
 * @method static Builder|Shop filter(array $input = [], $filter = null)
 * @method static Builder|Shop newModelQuery()
 * @method static Builder|Shop newQuery()
 * @method static Builder|Shop opening()
 * @method static Builder|Shop paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Shop query()
 * @method static Builder|Shop simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|Shop whereAuthState($value)
 * @method static Builder|Shop whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Shop whereBondState($value)
 * @method static Builder|Shop whereCity($value)
 * @method static Builder|Shop whereClosed($value)
 * @method static Builder|Shop whereCollectCount($value)
 * @method static Builder|Shop whereCreatedAt($value)
 * @method static Builder|Shop whereCumulativeSales($value)
 * @method static Builder|Shop whereDescription($value)
 * @method static Builder|Shop whereDistrict($value)
 * @method static Builder|Shop whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Shop whereIsPayReduceStock($value)
 * @method static Builder|Shop whereIsRefundRollbackStock($value)
 * @method static Builder|Shop whereIsSevenRefund($value)
 * @method static Builder|Shop whereLastReviews($value)
 * @method static Builder|Shop whereLatitude($value)
 * @method static Builder|Shop whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|Shop whereLogo($value)
 * @method static Builder|Shop whereLongitude($value)
 * @method static Builder|Shop whereMonthSales($value)
 * @method static Builder|Shop whereNewProducts($value)
 * @method static Builder|Shop whereNotice($value)
 * @method static Builder|Shop whereProvince($value)
 * @method static Builder|Shop whereScore($value)
 * @method static Builder|Shop whereSellerId($value)
 * @method static Builder|Shop whereShopId($value)
 * @method static Builder|Shop whereShopName($value)
 * @method static Builder|Shop whereStreet($value)
 * @method static Builder|Shop whereSubscribeCount($value)
 * @method static Builder|Shop whereTel($value)
 * @method static Builder|Shop whereTurnover($value)
 * @method static Builder|Shop whereType($value)
 * @method static Builder|Shop whereUpdatedAt($value)
 * @method static Builder|Shop whereViews($value)
 * @method static Builder|Shop whereVisitors($value)
 * @method static Builder|Shop whereWeixin($value)
 * @mixin \Eloquent
 */
class Shop extends Model
{
    use HasDates, Filterable;

    protected $table = 'shop';
    protected $primaryKey = 'shop_id';
    protected $fillable = [
        'seller_id', 'shop_name', 'type', 'logo', 'tel', 'weixin', 'province', 'city', 'district', 'street',
        'latitude', 'longitude', 'views', 'collect_count', 'subscribe_count', 'visitors', 'turnover',
        'month_sales', 'cumulative_sales', 'description', 'score', 'closed', 'bond_state',
        'auth_state', 'new_products', 'last_reviews', 'notice', 'is_seven_refund', 'is_pay_reduce_stock',
        'is_refund_rollback_stock'
    ];
    protected $casts = [
        'new_products' => 'array'
    ];
    protected $with = ['seller'];
    protected $appends = ['state_des', 'auth_state_des', 'bond_state_des', 'formatted_address', 'we_url'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function (Shop $shop) {
            $shop->certify()->create();
            $shop->stats()->create();
        });

        static::deleting(function (Shop $shop) {
            $shop->certify()->delete();
            $shop->stats()->delete();
        });
    }

    /**
     * @param $value
     * @return string
     */
    public function getLogoAttribute($value)
    {
        return $value ? image_url($value) : null;
    }

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = strip_image_url($value);
    }

    /**
     * @return string
     */
    public function getStateDesAttribute()
    {
        return trans('shop.shop_states.' . $this->closed);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getAuthStateDesAttribute()
    {
        return trans('shop.auth_states.' . $this->auth_state);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getBondStateDesAttribute()
    {
        return trans('shop.bond_states.' . $this->bond_state);
    }

    /**
     * @return string
     */
    public function getFormattedAddressAttribute()
    {
        if ($this->province == $this->city) {
            return $this->city . $this->district . $this->street;
        }
        return $this->province . $this->city . $this->district . $this->street;
    }

    /**
     * @return string|null
     */
    public function getWeUrlAttribute()
    {
        return is_null($this->shop_id) ? null : '/pages/waimai/shop/detail?shop_id=' . $this->shop_id;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function certify()
    {
        return $this->hasOne(ShopCertify::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ShopImage::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(ProductItem::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classifies()
    {
        return $this->hasMany(ProductClassify::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stats()
    {
        return $this->hasOne(ShopStats::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttrs()
    {
        return $this->hasMany(ProductAttr::class, 'shop_id', 'shop_id');
    }

    public function markAsClosed()
    {
        $this->forceFill(['closed' => 1])->save();
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->closed == 1;
    }


    public function markAsOpening()
    {
        $this->forceFill(['closed' => 0])->save();
    }


    public function isOpening()
    {
        return $this->closed == 0;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeOpening(Builder $builder)
    {
        return $builder->where('closed', 0);
    }
}
