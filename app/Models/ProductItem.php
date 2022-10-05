<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\ProductItem
 *
 * @property int $itemid 商品ID
 * @property int $seller_id 用户ID
 * @property int $shop_id 门店ID
 * @property int $cate_id 分类ID
 * @property string|null $title 宝贝标题
 * @property string|null $subtitle 宝贝卖点
 * @property string|null $merchant_code 商品编号
 * @property string $thumb 商品缩略图
 * @property string $image 商品图片
 * @property string|null $price 商品售价
 * @property int $purchase_limit 限购数量
 * @property string|null $original_price 商品原价
 * @property string|null $promotion_price 促销价
 * @property string|null $redpack_amount 红包金额
 * @property int $is_pin 是否拼团产品
 * @property int $pin_num 拼团人数
 * @property string $pin_price 拼团价格
 * @property int $sold 销量
 * @property int $stock 库存
 * @property int $views 浏览量
 * @property int $collect_count 收藏数量
 * @property int $review_count 评论数
 * @property array|null $attrs 商品属性
 * @property int $is_recommend 仓储推荐
 * @property int $is_promotion 是否促销
 * @property int $is_top 是否置顶
 * @property int $free_delivery 免运费
 * @property int $template_id 运费模板
 * @property int $is_weight_template 是否按重量计价
 * @property int $has_sku_attr 是否有多级型号
 * @property int $is_raffle 是否可抽奖
 * @property int $state 商品状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategory[] $bgCates
 * @property-read int|null $bg_cates_count
 * @property-read \App\Models\ProductCategory $category
 * @property-read \App\Models\ProductContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read array|string|null $state_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read string|null $we_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGroup[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductReview[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $seller
 * @property-read \App\Models\Shop $shop
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductSku[] $skus
 * @property-read int|null $skus_count
 * @property-read \App\Models\ProductTemplate $template
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereCollectCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereFreeDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereHasSkuAttr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsPromotion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsRaffle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsRecommend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsWeightTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereMerchantCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePinNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePurchaseLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereReviewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereViews($value)
 * @mixin \Eloquent
 */
class ProductItem extends Model
{
    use HasDates, HasThumbAttribute, HasImageAttribute, Filterable;

    protected $table = 'product_item';
    protected $primaryKey = 'itemid';
    protected $fillable = [
        'shop_id', 'cate_id', 'title', 'subtitle', 'merchant_code', 'thumb', 'image', 'price',
        'purchase_limit', 'original_price', 'promotion_price', 'redpack_amount', 'is_pin', 'pin_num',
        'pin_price', 'sold', 'stock', 'views', 'collect_count', 'review_count', 'attrs', 'is_recommend',
        'is_promotion', 'is_top', 'free_delivery', 'template_id', 'is_weight_template', 'has_sku_attr', 'state', 'is_hot'
    ];
    protected $hidden = ['seller_id', 'shop_id', 'cate_id', 'template_id'];
    protected $appends = ['url', 'm_url', 'we_url', 'state_des'];
    protected $casts = [
        'attrs' => 'array',
        'is_hot' => 'boolean'
    ];
    protected $with = ['shop', 'seller', 'images'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (ProductItem $productItem) {
            if (!$productItem->seller_id) {
                $productItem->seller()->associate(Auth::id());
            }
        });

        static::deleting(function (ProductItem $productItem) {
            $productItem->content()->delete();
            $productItem->images()->delete();
            $productItem->reviews->each->delete();
        });
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->itemid ? url('product/' . $this->itemid . '.html') : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getMUrlAttribute()
    {
        return $this->itemid ? '/product/detail/' . $this->itemid : null;
    }

    /**
     * @return string|null
     */
    public function getWeUrlAttribute()
    {
        return is_null($this->itemid) ? null : '/pages/product/detail?itemid=' . $this->itemid;
    }

    /**
     * @return array|string|null
     */
    public function getStateDesAttribute()
    {
        return is_null($this->state) ? null : trans('product.states.' . $this->state);
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
    public function incrementCollectCount($amount = 1)
    {
        return $this->increment('collect_count', $amount);
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
     * 宝贝所属用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|ProductContent
     */
    public function content()
    {
        return $this->hasOne(ProductContent::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skus()
    {
        return $this->hasMany(ProductSku::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function props()
    {
        return $this->hasMany(ProductProps::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(ProductTemplate::class, 'template_id', 'template_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->hasMany(ProductGroup::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'cate_id', 'cate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bgCates()
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'ecom_product_item_category',
            'product_id',
            'product_cate_id',
            'itemid',
            'cate_id'
        );
    }
}
