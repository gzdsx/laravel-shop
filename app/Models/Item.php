<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\Item
 *
 * @property int $itemid 商品ID
 * @property int $uid 用户ID
 * @property int $catid 宝贝分类
 * @property string|null $title 宝贝标题
 * @property string|null $subtitle 宝贝卖点
 * @property string|null $merchant_code 商品编号
 * @property string $thumb 商品缩略图
 * @property string $image 商品图片
 * @property float $price 商品价格
 * @property float $market_price 市场价格
 * @property float $redpack_amount 红包金额
 * @property int $isdiscount 是否有折扣
 * @property int $on_sale 出售状态,1=出售中,0=已下架
 * @property int $is_best 仓储推荐
 * @property int $stock 库存
 * @property int $sold 累计销量
 * @property int $views 浏览量
 * @property int $collections 收藏数量
 * @property int $reviews 评论数
 * @property float $shipping_fee 运费
 * @property string|null $unit 单位
 * @property int $freight_template 运费模板
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemReviews[] $buyerReviews
 * @property-read int|null $buyer_reviews_count
 * @property-read \App\Models\ItemCatlog $catlog
 * @property-read \App\Models\ItemContent $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemSkuAttr[] $skuAttrs
 * @property-read int|null $sku_attrs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemSku[] $skus
 * @property-read int|null $skus_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereFreightTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsBest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsdiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereMarketPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereMerchantCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereOnSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereViews($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use Filterable;

    protected $table = 'item';
    protected $primaryKey = 'itemid';
    protected $fillable = [
        'uid', 'catid', 'title', 'subtitle', 'merchant_code', 'thumb', 'image',
        'price', 'market_price', 'redpack_amount', 'isdiscount', 'on_sale', 'is_best', 'stock', 'sold', 'views',
        'shipping_fee', 'unit', 'freight_template', 'created_at', 'updated_at'
    ];
    protected $appends = ['url', 'h5_url'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (Item $item) {
            if (!$item->uid) $item->uid = Auth::id();
            if (!$item->market_price) $item->market_price = $item->price;
        });

        static::created(function (Item $item) {
            $item->content()->create();
        });

        static::deleted(function (Item $item) {
            $item->content()->delete();
            $item->images()->delete();
            $item->props()->delete();
            $item->skus()->delete();
            $item->skuAttrs()->delete();
        });

        static::addGlobalScope('available', function (Builder $builder) {
            return $builder->where('on_sale', 1);
        });
    }

    /**
     * @param $value
     * @return string
     */
    public function getThumbAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setThumbAttribute($value)
    {
        $this->attributes['thumb'] = strip_image_url($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = strip_image_url($value);
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return url('item/detail/' . $this->attributes['itemid'] . '.html');
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getH5UrlAttribute()
    {
        return url('h5/item/detail/' . $this->attributes['itemid'] . '.html');
    }

    /**
     * @param int $amount
     * @return int
     */
    public function incrementSold($amount = 1)
    {
        return $this->increment('sold', $amount);
    }

    /**
     * @param int $amount
     * @return int
     */
    public function incrementViews($amount = 1)
    {
        return $this->increment('views', $amount);
    }

    /**
     * @param int $amount
     * @return int
     */
    public function incrementCollections($amount = 1)
    {
        return $this->increment('collections', $amount);
    }

    /**
     * @param $amount
     * @return int
     */
    public function decreaseStock($amount)
    {
        return $this->newQuery()->where('itemid', $this->itemid)
            ->where('stock', '>=', $amount)
            ->decrement('stock', $amount);
    }

    /**
     * 宝贝详细
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
        return $this->hasOne(ItemContent::class, 'itemid');
    }

    /**
     * 宝贝图片
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ItemImage::class, 'itemid');
    }

    /**
     * 宝贝属性
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function props()
    {
        return $this->hasMany(ItemProps::class, 'itemid');
    }

    /**
     * 宝贝分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catlog()
    {
        return $this->belongsTo(ItemCatlog::class, 'catid', 'catid');
    }

    /**
     * 宝贝所属用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * 买家评价
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buyerReviews()
    {
        return $this->hasMany(ItemReviews::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skus()
    {
        return $this->hasMany(ItemSku::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skuAttrs()
    {
        return $this->hasMany(ItemSkuAttr::class, 'itemid', 'itemid');
    }
}
