<?php

namespace App\Models;

use App\Models\Traits\HasImageAttribute;
use App\Models\Traits\HasThumbAttribute;
use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\ProductItem
 *
 * @property int $itemid 商品ID
 * @property int $uid 用户ID
 * @property int $catid 分类ID
 * @property string|null $title 宝贝标题
 * @property string|null $subtitle 宝贝卖点
 * @property string|null $merchant_code 商品编号
 * @property string $thumb 商品缩略图
 * @property string $image 商品图片
 * @property string|null $price 商品售价
 * @property string|null $original_price 商品原价
 * @property string|null $promotion_price 促销价
 * @property string|null $redpack_amount 红包金额
 * @property int $isdiscount 是否有折扣
 * @property int $on_sale 出售状态,1=出售中,0=已下架
 * @property int $is_best 仓储推荐
 * @property int $stock 库存
 * @property int $sold 累计销量
 * @property int $views 浏览量
 * @property int $collections 收藏数量
 * @property int $reviews 评论数
 * @property string|null $unit 单位
 * @property array|null $attrs 商品属性
 * @property int $freight_template_id 运费模板
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductReview[] $buyerReviews
 * @property-read int|null $buyer_reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\ProductCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCate[] $cates
 * @property-read int|null $cates_count
 * @property-read \App\Models\ProductContent|null $content
 * @property-read \App\Models\FreightTemplate|null $freightTemplate
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read array|string|null $sale_state_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductSku[] $skus
 * @property-read int|null $skus_count
 * @property-read \App\Models\User $user
 * @method static Builder|ProductItem filter(array $input = [], $filter = null)
 * @method static Builder|ProductItem newModelQuery()
 * @method static Builder|ProductItem newQuery()
 * @method static Builder|ProductItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|ProductItem query()
 * @method static Builder|ProductItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static Builder|ProductItem whereAttrs($value)
 * @method static Builder|ProductItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|ProductItem whereCatid($value)
 * @method static Builder|ProductItem whereCollections($value)
 * @method static Builder|ProductItem whereCreatedAt($value)
 * @method static Builder|ProductItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static Builder|ProductItem whereFreightTemplateId($value)
 * @method static Builder|ProductItem whereImage($value)
 * @method static Builder|ProductItem whereIsBest($value)
 * @method static Builder|ProductItem whereIsdiscount($value)
 * @method static Builder|ProductItem whereItemid($value)
 * @method static Builder|ProductItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static Builder|ProductItem whereMerchantCode($value)
 * @method static Builder|ProductItem whereOnSale($value)
 * @method static Builder|ProductItem whereOriginalPrice($value)
 * @method static Builder|ProductItem wherePrice($value)
 * @method static Builder|ProductItem wherePromotionPrice($value)
 * @method static Builder|ProductItem whereRedpackAmount($value)
 * @method static Builder|ProductItem whereReviews($value)
 * @method static Builder|ProductItem whereSold($value)
 * @method static Builder|ProductItem whereStock($value)
 * @method static Builder|ProductItem whereSubtitle($value)
 * @method static Builder|ProductItem whereThumb($value)
 * @method static Builder|ProductItem whereTitle($value)
 * @method static Builder|ProductItem whereUid($value)
 * @method static Builder|ProductItem whereUnit($value)
 * @method static Builder|ProductItem whereUpdatedAt($value)
 * @method static Builder|ProductItem whereViews($value)
 * @mixin \Eloquent
 */
class ProductItem extends Model
{
    use Filterable, HasImageAttribute, HasThumbAttribute;

    protected $table = 'product_item';
    protected $primaryKey = 'itemid';
    protected $fillable = [
        'uid', 'catid', 'title', 'subtitle', 'merchant_code', 'thumb', 'image', 'price', 'original_price', 'promotion_price',
        'redpack_amount', 'isdiscount', 'on_sale', 'is_best', 'stock', 'sold', 'views', 'unit', 'freight_template_id', 'attrs'
    ];
    protected $appends = ['url', 'm_url', 'sale_state_des'];
    protected $casts = [
        'attrs' => 'array',
    ];
    protected $with = ['category'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (ProductItem $item) {
            if (!$item->uid) $item->uid = Auth::id();
        });

        static::created(function (ProductItem $item) {
            $item->content()->create();
        });

        static::deleted(function (ProductItem $item) {
            $item->content()->delete();
            $item->images()->delete();
            $item->props()->delete();
            $item->skus()->delete();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
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
        return $this->itemid ? url('h5/product/' . $this->itemid . '.html') : null;
    }

    /**
     * @return array|string|null
     */
    public function getSaleStateDesAttribute()
    {
        return is_null($this->on_sale) ? null : trans('product.sale_states.' . $this->on_sale);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'catid', 'catid');
    }

    /**
     * 宝贝详细
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
        return $this->hasOne(ProductContent::class, 'itemid');
    }

    /**
     * 宝贝图片
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'itemid');
    }

    /**
     * 宝贝属性
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function props()
    {
        return $this->hasMany(ProductProps::class, 'itemid');
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
        return $this->hasMany(ProductReview::class, 'itemid', 'itemid');
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
    public function cates()
    {
        return $this->hasMany(ProductCate::class, 'itemid', 'itemid');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function catePath()
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'product_cate',
            'itemid',
            'catid'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function freightTemplate()
    {
        return $this->hasOne(FreightTemplate::class, 'template_id', 'freight_template_id');
    }
}
