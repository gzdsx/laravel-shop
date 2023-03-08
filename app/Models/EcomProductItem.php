<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use App\Models\Traits\HasImageAttribute;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\EcomProductItem
 *
 * @property int $itemid 商品ID
 * @property int $cate_id 分类ID
 * @property int $seller_id 用户ID
 * @property int $shop_id 门店ID
 * @property string|null $title 宝贝标题
 * @property string|null $subtitle 宝贝卖点
 * @property string|null $merchant_code 商品编号
 * @property string $image 商品图片
 * @property string|null $price 一口价
 * @property string|null $original_price 商品原价
 * @property string|null $promotion_price 促销价
 * @property int $purchase_limit 限购数量
 * @property int $is_pin 是否拼团产品
 * @property int $pin_num 拼团人数
 * @property string $pin_price 拼团价格
 * @property int $sold 销量
 * @property int $stock 库存
 * @property int $views 浏览量
 * @property int $collect_count 收藏数量
 * @property int $review_count 评论数
 * @property array|null $attrs 商品属性
 * @property int $is_new 是否新品
 * @property bool $is_hot 是否热销
 * @property int $is_recommend 仓储推荐
 * @property int $is_promotion 是否促销
 * @property int $is_top 是否置顶
 * @property int $free_delivery 免运费
 * @property int $template_id 运费模板
 * @property int $is_weight_template 是否按重量计价
 * @property int $has_sku_attr 是否有多级型号
 * @property int $brand_id 品牌
 * @property int $state 商品状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductCategory[] $bgCates
 * @property-read int|null $bg_cates_count
 * @property-read \App\Models\EcomProductCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $collectedUsers
 * @property-read int|null $collected_users_count
 * @property-read \App\Models\EcomProductContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read array|string|null $status_des
 * @property-read mixed $thumb
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read string|null $we_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductGroup[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductReview[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User|null $seller
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductSku[] $skus
 * @property-read int|null $skus_count
 * @property-read \App\Models\EcomProductTemplate|null $template
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereCollectCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereFreeDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereHasSkuAttr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsPromotion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsRecommend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsWeightTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereMerchantCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem wherePinNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem wherePinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem wherePurchaseLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereReviewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereViews($value)
 * @mixin \Eloquent
 */
class EcomProductItem extends Model
{
    use HasDates, HasImageAttribute, Filterable;

    protected $table = 'ecom_product_item';
    protected $primaryKey = 'itemid';
    protected $fillable = [
        'shop_id', 'cate_id', 'title', 'subtitle', 'merchant_code', 'image', 'price',
        'purchase_limit', 'original_price', 'promotion_price', 'is_pin', 'pin_num',
        'pin_price', 'sold', 'stock', 'views', 'collect_count', 'review_count', 'attrs', 'is_recommend',
        'is_promotion', 'is_top', 'free_delivery', 'template_id', 'is_weight_template', 'has_sku_attr',
        'is_hot', 'is_new', 'brand_id', 'state'
    ];
    protected $hidden = ['seller_id'];
    protected $appends = ['url', 'm_url', 'we_url', 'state_des', 'thumb'];
    protected $casts = [
        'attrs' => 'array',
        'is_hot' => 'boolean'
    ];
    protected $with = ['shop', 'seller', 'images'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (EcomProductItem $productItem) {
            if (!$productItem->seller_id) {
                $productItem->seller()->associate(Auth::id());
            }
        });

        static::deleting(function (EcomProductItem $productItem) {
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
        return is_null($this->state) ? null : trans('product.state_options.' . $this->state);
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
        return $this->belongsTo(EcomShop::class, 'shop_id', 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|EcomProductContent
     */
    public function content()
    {
        return $this->hasOne(EcomProductContent::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(EcomProductImage::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|EcomProductSku
     */
    public function skus()
    {
        return $this->hasMany(EcomProductSku::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(EcomProductReview::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function props()
    {
        return $this->hasMany(EcomProductProps::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(EcomProductTemplate::class, 'template_id', 'template_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->hasMany(EcomProductGroup::class, 'itemid', 'itemid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(EcomProductCategory::class, 'cate_id', 'cate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bgCates()
    {
        return $this->belongsToMany(
            EcomProductCategory::class,
            'ecom_product_item_category',
            'product_id',
            'product_cate_id',
            'itemid',
            'cate_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|User
     */
    public function collectedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'ecom_product_collect_user',
            'collect_itemid',
            'collect_uid',
            'itemid',
            'uid'
        )->as('collect')
            ->withTimestamps()
            ->orderBy('ecom_product_collect_user.created_at', 'desc');
    }

    public function getThumbAttribute()
    {
        return $this->image;
    }
}
