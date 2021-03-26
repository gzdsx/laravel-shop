<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $uid 会员ID
 * @property string|null $password 支付密码
 * @property string $balance 账户余额
 * @property string|null $freeze 冻结金额
 * @property string $total_income 累计收入
 * @property string $total_cost 累计支出
 * @property int $points 积分
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTotalIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUid($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ad
 *
 * @property int $id ID
 * @property int $uid
 * @property string|null $title 标题
 * @property string $type
 * @property array|null $data
 * @property int $clicks
 * @property int $available 是否可用
 * @property string|null $begin_at
 * @property string|null $end_at
 * @property-read array|string|null $state_des
 * @property-read mixed|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUid($value)
 */
	class Ad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Block
 *
 * @property int $block_id
 * @property string|null $block_name
 * @property string|null $block_desc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BlockItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereBlockDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereBlockName($value)
 */
	class Block extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlockItem
 *
 * @property int $id
 * @property int $block_id
 * @property string|null $title 标题
 * @property string $image 图片
 * @property string|null $url 链接
 * @property string|null $subtitle 副标题
 * @property string|null $field_1
 * @property string|null $field_2
 * @property string|null $field_3
 * @property int|null $displayorder 显示顺序
 * @property-read \App\Models\Block $block
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockItem whereUrl($value)
 */
	class BlockItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BuyLog
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $buyable_type 类型
 * @property int $buyable_id 类型ID
 * @property int $pay_state 支付状态
 * @property int $transaction_id 交易ID
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\Transaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereBuyableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereBuyableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuyLog whereUpdatedAt($value)
 */
	class BuyLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string|null $title
 * @property int $quantity
 * @property string $price 商品价格
 * @property string $thumb
 * @property string $image
 * @property int $sku_id
 * @property string|null $sku_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Cart[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\ProductItem $product
 * @property-read \App\Models\ProductSku|null $sku
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Cart groupByShop()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id ID
 * @property int $fid 父级ID
 * @property string|null $name 名称
 * @property int $level 级别
 * @property int $usetype 使用类型
 * @property int $displayorder 排序
 * @property string|null $zone_code
 * @property float|null $lng
 * @property float|null $lat
 * @property string|null $pinyin
 * @property string|null $letter
 * @property string|null $citycode 区号
 * @property string|null $zipcode 邮编
 * @property-read \Illuminate\Database\Eloquent\Collection|District[] $childs
 * @property-read int|null $childs_count
 * @property-read District $parent
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCitycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUsetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereZoneCode($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Express
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $regular
 * @property int $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|Express newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Express newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Express query()
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereRegular($value)
 */
	class Express extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int $uid
 * @property string|null $username
 * @property string|null $title
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUsername($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FreightTemplate
 *
 * @property int $template_id 模板ID
 * @property string|null $template_name 模板名称
 * @property int $valuation 计价方式
 * @property int $start_quantity 默认数量
 * @property string $start_fee 默认运费
 * @property int $growth_quantity 递增数量
 * @property string $growth_fee 递增运费
 * @property string|null $delivery_areas 配送区域
 * @property string $free_amount 包邮金额
 * @property int $free_quantity 包邮数量
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereDeliveryAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereFreeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereFreeQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereGrowthFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereGrowthQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereStartFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereStartQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreightTemplate whereValuation($value)
 */
	class FreightTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JPush
 *
 * @property int $id
 * @property int|null $uid
 * @property string|null $appid
 * @property string|null $ios
 * @property string|null $android
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|JPush android()
 * @method static \Illuminate\Database\Eloquent\Builder|JPush ios()
 * @method static \Illuminate\Database\Eloquent\Builder|JPush newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JPush newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JPush query()
 * @method static \Illuminate\Database\Eloquent\Builder|JPush whereAndroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JPush whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JPush whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JPush whereIos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JPush whereUid($value)
 */
	class JPush extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Label
 *
 * @property int $id 主键
 * @property string|null $title 名称
 * @property string|null $content 内容
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|Label newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label query()
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereUpdatedAt($value)
 */
	class Label extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Link
 *
 * @property int $id
 * @property int $catid
 * @property string $type
 * @property string|null $title
 * @property string|null $url
 * @property string $image
 * @property string|null $description
 * @property int $displayorder
 * @property-read Link $category
 * @property-read \Illuminate\Database\Eloquent\Collection|Link[] $links
 * @property-read int|null $links_count
 * @method static \Illuminate\Database\Eloquent\Builder|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|Link onlyLink()
 * @method static \Illuminate\Database\Eloquent\Builder|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUrl($value)
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Live
 *
 * @property int $id
 * @property int|null $uid 用户
 * @property int $channel_id 频道
 * @property string|null $stream_id 直播流ID
 * @property string|null $title 话题
 * @property string $image 海报
 * @property string|null $video_id 录制视频ID
 * @property string|null $video_url 录制视频地址
 * @property string|null $content 直播介绍
 * @property int $id_position ID显示位置
 * @property int $watch_mode 观看方式
 * @property string $price 观看价格
 * @property int $state 状态
 * @property int $views 浏览量
 * @property \Illuminate\Support\Carbon|null $start_at 开始时间
 * @property \Illuminate\Support\Carbon|null $expires_at 过期时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyLog[] $buyLogs
 * @property-read int|null $buy_logs_count
 * @property-read \App\Models\LiveChannel $channel
 * @property-read string|null $flv
 * @property-read string|null $hls
 * @property-read string|null $hls_hd
 * @property-read string|null $hls_low
 * @property-read string|null $hls_play_url
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $m_url
 * @property-read \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed $obs_push_url
 * @property-read string|null $obs_stream_name
 * @property-read string|null $push_url
 * @property-read mixed $state_des
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $url
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Live filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Live newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Live newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Live paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Live query()
 * @method static \Illuminate\Database\Eloquent\Builder|Live simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereIdPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Live wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereVideoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereWatchMode($value)
 */
	class Live extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveChannel
 *
 * @property int $channel_id
 * @property string|null $name
 * @property int $displayorder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Live[] $lives
 * @property-read int|null $lives_count
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel whereName($value)
 */
	class LiveChannel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Material
 *
 * @property int $id
 * @property int $uid
 * @property string|null $name
 * @property string $thumb
 * @property string $source
 * @property string|null $width
 * @property string|null $height
 * @property string|null $type
 * @property string|null $extension 扩展名
 * @property int $size
 * @property string|null $mime
 * @property int $views
 * @property int $downloads
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|string $formated_size
 * @property-read string $image
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Material doc()
 * @method static \Illuminate\Database\Eloquent\Builder|Material file()
 * @method static \Illuminate\Database\Eloquent\Builder|Material filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Material image()
 * @method static \Illuminate\Database\Eloquent\Builder|Material newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Material query()
 * @method static \Illuminate\Database\Eloquent\Builder|Material simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Material video()
 * @method static \Illuminate\Database\Eloquent\Builder|Material voice()
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereWidth($value)
 */
	class Material extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $menu_id
 * @property string|null $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereTitle($value)
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int $fid
 * @property string|null $title
 * @property string|null $url
 * @property string $image
 * @property string $target
 * @property int $displayorder
 * @property int $available
 * @property-read \Illuminate\Database\Eloquent\Collection|MenuItem[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Menu $menu
 * @property-read MenuItem $parent
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereUrl($value)
 */
	class MenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $order_id 主键
 * @property int $order_type 订单类型
 * @property string|null $order_no 订单编号
 * @property int $order_state 订单状态:1=未付款,2=已付款,3=已发货,4=交易成功,5=交易关闭
 * @property int $buyer_id 买家ID
 * @property string|null $buyer_name 买家账号
 * @property string|null $remark 买家留言
 * @property string $product_fee 商品总价
 * @property string $shipping_fee 运费
 * @property string $discount_fee 优惠金额
 * @property string $order_fee 付款金额
 * @property string $total_fee 订单总额
 * @property int $coupon_id 优惠券
 * @property int $total_count 商品数量
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_state 支付状态，1=已支付，0=未支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property int $shipping_type 配送方式
 * @property int $shipping_state 发货状态，0=未发货，1=已发货
 * @property \Illuminate\Support\Carbon|null $shipping_at 发货时间
 * @property int $receive_state 收货状态，0=未收货，1=已收货
 * @property \Illuminate\Support\Carbon|null $receive_at 收货时间
 * @property int $buyer_rate 买家评价状态，0=未评价，1=已评价
 * @property int $seller_rate 卖家评价状态，0=未评价，1=已评价
 * @property int $refund_state 退款状态，0=无退款，1=退款中，2=退款完成
 * @property \Illuminate\Support\Carbon|null $refund_at 退款时间
 * @property int $closed 关闭状态
 * @property \Illuminate\Support\Carbon|null $closed_at 关闭时间
 * @property int $buyer_deleted 买家已删除
 * @property int $seller_deleted 卖家已删除
 * @property int|null $transaction_id 关联交易记录
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $buyer
 * @property-read \App\Models\OrderCloseReason|null $closeReason
 * @property-read mixed|null $buyer_state_des
 * @property-read mixed|null $order_state_des
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $seller_state_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Refund[] $refunds
 * @property-read int|null $refunds_count
 * @property-read \App\Models\OrderShipping|null $shipping
 * @property-read \App\Models\Transaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|Order filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscountFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereReceiveAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereReceiveState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRefundAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSellerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSellerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderClosed
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property string|null $reason 关闭原因
 * @property \Illuminate\Support\Carbon|null $created_at 关闭时间
 * @property \Illuminate\Support\Carbon|null $updated_at 关闭时间
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCloseReason whereUpdatedAt($value)
 */
	class OrderCloseReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderItem
 *
 * @property int $sub_order_id 主键
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property string|null $title 商品名称
 * @property string $price 商品价格
 * @property string $promotion_price 促销价
 * @property string $thumb 缩略图
 * @property string $image 商品图片
 * @property int $quantity 商品数量
 * @property int|null $sku_id 属性ID
 * @property string|null $sku_title 商品属性
 * @property string $product_fee 商品总价
 * @property string $shipping_fee 运费
 * @property string $discount_fee 优惠金额
 * @property string $total_fee 订单总价
 * @property string $order_fee 实付金额
 * @property string $redpack_amount 红包金额
 * @property int $refund_id 关联退款记录
 * @property int $refund_state 退款状态
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\ProductItem|null $product
 * @property-read \App\Models\Refund $refund
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDiscountFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSubOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTotalFee($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderAction
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property int $uid 操作用户ID
 * @property string|null $username
 * @property string|null $content 操作内容
 * @property \Illuminate\Support\Carbon|null $created_at 操作时间
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereUsername($value)
 */
	class OrderLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property string|null $express_code 快递公司编号
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $tel 联系电话
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_address
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereUpdatedAt($value)
 */
	class OrderShipping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pages
 *
 * @property int $pageid
 * @property string $type
 * @property int $catid
 * @property string|null $title
 * @property string|null $alias
 * @property string|null $image
 * @property string|null $summary
 * @property string|null $content
 * @property string|null $template
 * @property int $displayorder
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Page $category
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|Page[] $pages
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|Page onlyPage()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePageid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostCategory
 *
 * @property int $catid 主键
 * @property int $fid 父级分类
 * @property string|null $name 分类名称
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property int $displayorder 显示顺序
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read PostCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryModel enable()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateList($value)
 */
	class PostCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $aid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostItem|null $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCollect whereUpdatedAt($value)
 */
	class PostCollect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostComment
 *
 * @property int $id
 * @property int $aid
 * @property int $uid
 * @property string|null $username
 * @property int $reply_uid
 * @property string|null $reply_name
 * @property string|null $message
 * @property string|null $province
 * @property string|null $city
 * @property string|null $street
 * @property int $likes
 * @property int $state 审核状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostItem $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereReplyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereReplyUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUsername($value)
 */
	class PostComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostContent
 *
 * @property int $aid
 * @property string|null $content
 * @property int $pageorder
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent wherePageorder($value)
 */
	class PostContent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostImage
 *
 * @property int $id
 * @property int $aid 数据ID
 * @property string $image
 * @property string $thumb
 * @property int $isremote
 * @property string|null $description
 * @property int $displayorder
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereIsremote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereThumb($value)
 */
	class PostImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostItem
 *
 * @property int $aid 文章ID
 * @property int $uid 会员ID
 * @property int $catid 分类ID
 * @property string|null $author 作者
 * @property string|null $type 文章形式
 * @property string|null $title 文章标题
 * @property string|null $alias 别名
 * @property string|null $summary 摘要
 * @property string $image 图片
 * @property array|null $tags 标签
 * @property int $allowcomment 允许评论
 * @property int $collections 被收藏数
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $comments 评论数
 * @property int $views 浏览数
 * @property int $likes 点赞数
 * @property int $state 0：待审,1:已审核,-1:审核不过
 * @property string|null $from 来源
 * @property string|null $fromurl 来源地址
 * @property int $contents 内容数
 * @property float $price 阅读价格
 * @property int $click1
 * @property int $click2
 * @property int $click3
 * @property int $click4
 * @property int $click5
 * @property int $click6
 * @property int $click7
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostCategory $category
 * @property-read int|null $comments_count
 * @property-read \App\Models\PostContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read mixed $state_des
 * @property-read mixed $type_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\PostMedia|null $media
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereAllowcomment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereFromurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereViews($value)
 */
	class PostItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostLog
 *
 * @property int $aid
 * @property int $uid
 * @property string|null $title
 * @property string|null $action_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereUpdatedAt($value)
 */
	class PostLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostMedia
 *
 * @property int $id
 * @property int $aid
 * @property string|null $media_id
 * @property string|null $media_from
 * @property string|null $media_title
 * @property string $media_thumb
 * @property string|null $media_player
 * @property string|null $media_link
 * @property string|null $media_tags
 * @property string|null $media_description
 * @property string|null $media_source
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMedia whereMediaTitle($value)
 */
	class PostMedia extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostTag
 *
 * @property int $tag_id
 * @property string $tag_name
 * @property int $tag_count
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagName($value)
 */
	class PostTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PrePay
 *
 * @property string $out_trade_no 单号
 * @property int|null $uid 付款人ID
 * @property string|null $username 付款人账号
 * @property string|null $prepay_id prepay_id
 * @property array|null $data 支付数据
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay wherePrepayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrePay whereUsername($value)
 */
	class PrePay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductAttrValue
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrValue query()
 */
	class ProductAttrValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductAttrs
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_title 属性名称
 * @property string|null $attr_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs whereAttrTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttrs whereAttrValue($value)
 */
	class ProductAttrs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCate
 *
 * @property int $id
 * @property int|null $itemid
 * @property int|null $catid
 * @property-read \App\Models\ProductCategory|null $catlog
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCate whereItemid($value)
 */
	class ProductCate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCategory
 *
 * @property int $catid 主键
 * @property int $fid 父级分类
 * @property string|null $name 分类名称
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $displayorder 显示顺序
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $items
 * @property-read int|null $items_count
 * @property-read ProductCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategoryProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryModel enable()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTemplateList($value)
 */
	class ProductCategory extends \Eloquent {}
}

namespace App\Models{
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
 */
	class ProductCategoryProps extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string|null $title
 * @property string $image
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductItem|null $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCollect whereUpdatedAt($value)
 */
	class ProductCollect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductContent
 *
 * @property int $itemid
 * @property string|null $content
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductContent whereItemid($value)
 */
	class ProductContent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $itemid
 * @property string $thumb
 * @property string $image
 * @property int $displayorder
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereThumb($value)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereFreightTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsBest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereIsdiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereMerchantCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereOnSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductItem whereViews($value)
 */
	class ProductItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductProps
 *
 * @property int $id
 * @property int $itemid
 * @property int $prop_id
 * @property string|null $prop_name
 * @property string|null $prop_value
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps wherePropName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProps wherePropValue($value)
 */
	class ProductProps extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductReview
 *
 * @property int $id 主键
 * @property int $uid 用户
 * @property int $itemid 关联商品
 * @property int $order_id 关联订单
 * @property string|null $message 评论内容
 * @property int|null $item_star 商品评分
 * @property int $service_star 服务评分
 * @property int $wuliu_star 物流评分
 * @property int $anony 匿名评论
 * @property \Illuminate\Support\Carbon|null $created_at 评论时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductReviewImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\ProductItem $item
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereAnony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereItemStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereServiceStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereWuliuStar($value)
 */
	class ProductReview extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductReviewImage
 *
 * @property int $id
 * @property int $review_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviewImage whereThumb($value)
 */
	class ProductReviewImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductSku
 *
 * @property int $sku_id
 * @property int $itemid 商品ID
 * @property string|null $title
 * @property string|null $image 图片
 * @property string $price 价格
 * @property int $stock 库存
 * @property string|null $code SKU编码
 * @property string|null $properties 属性组合
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSku whereTitle($value)
 */
	class ProductSku extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderRefund
 *
 * @property int $refund_id 主键
 * @property int $uid 用户ID
 * @property int $order_id 订单ID
 * @property string|null $refund_no 退款单号
 * @property int $refund_type 退货类型,1=仅退款,2=退货退款
 * @property int $refund_state 处理状态
 * @property string|null $refund_reason 退货原因
 * @property string|null $refund_desc 退款说明
 * @property string $refund_amount 退款金额
 * @property string|null $refund_remark 备注
 * @property string $shipping_fee 退货运费
 * @property int $receive_state 货物状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $receive_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $refund_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $refund_type_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Order $order
 * @property-read Refund $refund
 * @property-read \App\Models\RefundShipping|null $shipping
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereReceiveState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUpdatedAt($value)
 */
	class Refund extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $address_id
 * @property int $uid
 * @property int $shop_id
 * @property string|null $name
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property int $isdefault
 * @property-read string $full_address
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress whereUid($value)
 */
	class RefundAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefundImage
 *
 * @property int $id
 * @property int $refund_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundImage whereThumb($value)
 */
	class RefundImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefundReason
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason whereTitle($value)
 */
	class RefundReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderShipping
 *
 * @property int $id 主键
 * @property int $refund_id 订单ID
 * @property string|null $express_code 快递编码
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $tel 联系电话
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $street 街道
 * @property string|null $postalcode 邮编
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read string $full_address
 * @property-read \App\Models\Refund $refund
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereUpdatedAt($value)
 */
	class RefundShipping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Settings
 *
 * @property string $skey 标识
 * @property string|null $svalue 值
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereSkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereSvalue($value)
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscribe
 *
 * @property int $id
 * @property int $uid
 * @property int $subscribe_uid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $subscribeUser
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereSubscribeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereUpdatedAt($value)
 */
	class Subscribe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $transaction_id 主键
 * @property string|null $transaction_type 交易类型
 * @property string|null $out_trade_no 交易流水
 * @property int $payer_id 付款方ID
 * @property string|null $payer_name 付款方账号
 * @property int $payee_id 收款方ID
 * @property string|null $payee_name 收款方账户
 * @property string|null $pay_type 支付方式
 * @property int $pay_state 支付状态,0=未支付，1=已支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property string|null $subject 交易名称
 * @property string $amount 交易金额
 * @property string|null $remark 备注
 * @property array|null $data 付款信息
 * @property \Illuminate\Support\Carbon|null $created_at 交易时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $buyable
 * @property-read mixed|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $transaction_type_des
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User $payee
 * @property-read \App\Models\User $payer
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayeeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $uid 主键
 * @property int $gid 管理权限
 * @property int $admincp 是否允许登录后台
 * @property string|null $username 会员名
 * @property string|null $email 邮箱
 * @property string|null $mobile 手机号
 * @property string|null $password 密码
 * @property string|null $remember_token
 * @property string|null $avatar 头像
 * @property int $state 状态
 * @property int $email_state 邮箱验证状态
 * @property int $avatar_state 头像验证状态
 * @property int $auth_state 实名认证状态
 * @property int $freeze 冻结账户
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\UserAuth|null $auth
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $boughts
 * @property-read int|null $boughts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyLog[] $buyLogs
 * @property-read int|null $buy_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $carts
 * @property-read int|null $carts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $collectedPosts
 * @property-read int|null $collected_posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserConnect[] $connects
 * @property-read int|null $connects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscribe[] $fans
 * @property-read int|null $fans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserField[] $fields
 * @property-read int|null $fields_count
 * @property-read array|string|null $state_des
 * @property-read \App\Models\UserGroup $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Material[] $materials
 * @property-read int|null $materials_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCollect[] $postCollects
 * @property-read int|null $post_collects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCollect[] $productCollects
 * @property-read int|null $product_collects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \App\Models\UserStat|null $stat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscribe[] $subscribes
 * @property-read int|null $subscribes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $address_id
 * @property int $uid
 * @property string|null $name
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property int $isdefault
 * @property-read string $full_address
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUid($value)
 */
	class UserAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAuth
 *
 * @property int $uid 用户ID
 * @property string|null $name 姓名
 * @property string|null $pin 身份证号
 * @property string $id_front 身份证正面
 * @property string $id_back 身份证背面
 * @property string $id_hand 手持身份证
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereIdBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereIdFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereIdHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereUpdatedAt($value)
 */
	class UserAuth extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserConnect
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $appid APPID
 * @property string|null $platform 平台
 * @property string|null $unionid UnionID
 * @property string|null $openid 开放ID
 * @property string|null $nickname 昵称
 * @property int $gender 性别
 * @property string|null $city 城市
 * @property string|null $province 省，州
 * @property string|null $country 国籍
 * @property string|null $avatar 头像地址
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConnect whereUpdatedAt($value)
 */
	class UserConnect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserField
 *
 * @property int $id
 * @property int $uid
 * @property string|null $name
 * @property string|null $value
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserField query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereValue($value)
 */
	class UserField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGroup
 *
 * @property int $gid
 * @property string|null $title
 * @property string|null $type
 * @property int $creditslower
 * @property int $creditshigher
 * @property array|null $privileges
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup systemGroups()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup userGroups()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereCreditshigher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereCreditslower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup wherePrivileges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereType($value)
 */
	class UserGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserLog
 *
 * @property int $id
 * @property int $uid
 * @property string|null $ip
 * @property string|null $operate
 * @property string|null $address
 * @property string|null $src
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereOperate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUpdatedAt($value)
 */
	class UserLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserInfo
 *
 * @property int $uid 用户ID
 * @property string|null $realname 真实姓名
 * @property int $gender 性别
 * @property string|null $birthday 生日
 * @property int $blood 血型
 * @property int $star 星座
 * @property string|null $country 国籍
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $town 乡镇
 * @property string|null $street 街道
 * @property string|null $bio 个人简介
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRealname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserStat
 *
 * @property int $uid
 * @property int $posts
 * @property int $comments
 * @property int $albums
 * @property int $photos
 * @property int $follower
 * @property int $following
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereAlbums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStat whereUid($value)
 */
	class UserStat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string|null $code 验证码
 * @property string|null $mobile 手机号
 * @property string|null $email 邮箱
 * @property int $used 已使用
 * @property \Illuminate\Support\Carbon|null $created_at 发送时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|Verify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify query()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUsed($value)
 */
	class Verify extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Video
 *
 * @property int $id
 * @property string|null $title
 * @property string $image
 * @property string|null $content
 * @property string|null $source
 * @property string|null $link
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $m_url
 * @property-read mixed $player
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereViews($value)
 */
	class Video extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WxLogin
 *
 * @property int $id
 * @property int $uid
 * @property string|null $basestr
 * @property string|null $openid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereBasestr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereUpdatedAt($value)
 */
	class WechatLogin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WechatMenu
 *
 * @property int $id
 * @property int $fid
 * @property string|null $name
 * @property string|null $type
 * @property string|null $key
 * @property string|null $media_id
 * @property string|null $url
 * @property string|null $appid
 * @property string|null $pagepath
 * @property int $displayorder
 * @property-read \Illuminate\Database\Eloquent\Collection|WechatMenu[] $children
 * @property-read int|null $children_count
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu wherePagepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereUrl($value)
 */
	class WechatMenu extends \Eloquent {}
}

