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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WechatMenu[] $children
 * @property-read int|null $children_count
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu wherePagepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereUrl($value)
 */
	class WechatMenu extends \Eloquent {}
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
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material doc()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material file()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material image()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material video()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material voice()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereWidth($value)
 */
	class Material extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FreightTemplate
 *
 * @property int $template_id 模板ID
 * @property string|null $template_name 模板名称
 * @property int $valuation 计价方式
 * @property int $start_quantity 默认数量
 * @property float $start_fee 默认运费
 * @property int $growth_quantity 递增数量
 * @property float $growth_fee 递增运费
 * @property string|null $delivery_areas 配送区域
 * @property float $free_amount 包邮金额
 * @property int $free_quantity 包邮数量
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereDeliveryAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereFreeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereFreeQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereGrowthFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereGrowthQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereStartFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereStartQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreightTemplate whereValuation($value)
 */
	class FreightTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $transaction_id
 * @property string|null $transaction_no 交易号
 * @property string|null $transaction_type 交易类型
 * @property int $transaction_state 交易状态
 * @property int $payer_uid 付款方ID
 * @property string|null $payer_name 付款方账号
 * @property int $payee_uid 收款方ID
 * @property string|null $payee_name 收款方账户
 * @property string|null $pay_type 支付方式
 * @property int $pay_state 支付状态,0=未支付，1=已支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property string|null $subject 交易名称
 * @property string|null $detail 交易描述
 * @property float $amount 交易金额
 * @property string|null $out_trade_no 第三方支付订单号
 * @property array|null $extra 第三方支付信息
 * @property int $order_id 关联订单
 * @property \Illuminate\Support\Carbon|null $created_at 交易时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $transaction_state_des
 * @property-read mixed|null $transaction_type_des
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $payee
 * @property-read \App\Models\User $payer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayeeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayeeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePayerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 */
	class Transaction extends \Eloquent {}
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
 * @property-read \App\Models\Refund $refund
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundShipping whereUpdatedAt($value)
 */
	class RefundShipping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemImage
 *
 * @property int $id
 * @property int $itemid
 * @property string $thumb
 * @property string $image
 * @property int $displayorder
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereThumb($value)
 */
	class ItemImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderRefund
 *
 * @property int $refund_id 主键
 * @property int $trade_id 子订单号
 * @property int $order_id 订单ID
 * @property string|null $refund_no 退款单号
 * @property int $refund_type 退货类型,1=仅退款,2=退货退款
 * @property int $refund_state 处理状态
 * @property string|null $refund_reason 退货原因
 * @property string|null $refund_desc 退款说明
 * @property float $refund_amount 退款金额
 * @property int $receive_state 货物状态
 * @property string|null $express_code 物流代码
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $tel 联系电话
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $refund_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $refund_type_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\OrderItem $orderItem
 * @property-read \App\Models\RefundShipping|null $shipping
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereReceiveState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereRefundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Refund whereUpdatedAt($value)
 */
	class Refund extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereUid($value)
 */
	class Ad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeviceToken
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken query()
 */
	class DeviceToken extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemSku
 *
 * @property int $id
 * @property int $itemid 商品ID
 * @property string|null $title
 * @property string|null $image 图片
 * @property float $price 价格
 * @property int $stock 库存
 * @property string|null $code SKU编码
 * @property string|null $properties 属性组合
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductSku whereTitle($value)
 */
	class ItemSku extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemProps
 *
 * @property int $id
 * @property int $itemid
 * @property int $prop_id
 * @property string|null $prop_name
 * @property string|null $prop_value
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps wherePropName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProps wherePropValue($value)
 */
	class ItemProps extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property int $shipping_type
 * @property string|null $express_code 快递公司编号
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_address
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereUpdatedAt($value)
 */
	class OrderShipping extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush android()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush ios()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereAndroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereIos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JPush whereUid($value)
 */
	class JPush extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostContent
 *
 * @property int $aid
 * @property string|null $content
 * @property int $pageorder
 * @property-read \App\Models\PostItem $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent wherePageorder($value)
 */
	class PostContent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Settings
 *
 * @property string $skey 标识
 * @property string|null $svalue 值
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSvalue($value)
 */
	class Settings extends \Eloquent {}
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
 * @property float $price 商品价格
 * @property string $thumb
 * @property string $image
 * @property int $sku_id
 * @property string|null $sku_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductItem $item
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\ProductSku|null $sku
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart groupByShop()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUpdatedAt($value)
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemContent
 *
 * @property int $itemid
 * @property string|null $content
 * @property-read \App\Models\ProductItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductContent whereItemid($value)
 */
	class ItemContent extends \Eloquent {}
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
 * @property-read \App\Models\Link $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Link[] $links
 * @property-read int|null $links_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link onlyLink()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereUrl($value)
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $order_id
 * @property int $order_type 订单类型
 * @property string|null $order_no 订单编号
 * @property int $order_state 订单状态:1=未付款,2=已付款,3=已发货,4=交易成功,5=交易关闭
 * @property int $buyer_uid 买家ID
 * @property string|null $buyer_name 买家账号
 * @property string|null $remark 买家留言
 * @property float $goods_fee 商品总价
 * @property float $shipping_fee 运费
 * @property float $discount_fee 优惠金额
 * @property float $order_fee 付款金额
 * @property float $total_fee 订单总额
 * @property int $total_count 商品数量
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_state 支付状态，1=已支付，0=未支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
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
 * @property-read \App\Models\User $seller
 * @property-read \App\Models\OrderShipping|null $shipping
 * @property-read \App\Models\Transaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDiscountFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereGoodsFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReceiveAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReceiveState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereSubscribeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUpdatedAt($value)
 */
	class Subscribe extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereUrl($value)
 */
	class BlockItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemAttr
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_title 属性名称
 * @property string|null $attr_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrs whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrs whereAttrTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrs whereAttrValue($value)
 */
	class ItemAttrs extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUid($value)
 */
	class Address extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin whereBasestr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatLogin whereUpdatedAt($value)
 */
	class WechatLogin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemCatlog
 *
 * @property int $catid
 * @property int $fid 父级分类
 * @property string|null $name 分类名称
 * @property string|null $identifier
 * @property string $icon 图片
 * @property int $displayorder 显示顺序
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\ProductCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategoryProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory enable()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereTemplateList($value)
 */
	class ItemCatlog extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereRegular($value)
 */
	class Express extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemCatlogProps
 *
 * @property int $prop_id
 * @property int $catid
 * @property string|null $title
 * @property string|null $type
 * @property int $required
 * @property string|null $default
 * @property string|null $options
 * @property string|null $rules
 * @property-read \App\Models\ProductCategory $catlog
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategoryProps whereType($value)
 */
	class ItemCatlogProps extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderItem
 *
 * @property int $trade_id 主键
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property string|null $title 商品名称
 * @property float $price 商品价格
 * @property float $promotion_price 优惠价
 * @property float $discount 折扣比例
 * @property string $thumb 缩略图
 * @property string $image 商品图片
 * @property int $quantity 商品数量
 * @property int $sku_id 属性ID
 * @property string|null $sku_title 商品属性
 * @property float $promotion_fee 优惠费用
 * @property float $shipping_fee 运费
 * @property float $total_fee 总费用
 * @property float $redpack_amount 红包金额
 * @property int $coupon_id 优惠券
 * @property int $trade_state 交易状态
 * @property string|null $refund_no 退款单号
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Refund|null $refund
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePromotionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTradeState($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $uid
 * @property int $gid 管理权限
 * @property int $admincp 是否允许登录后台
 * @property string|null $username 用户名
 * @property string|null $email 邮箱
 * @property string|null $mobile 手机号
 * @property string|null $password 密码
 * @property string|null $remember_token
 * @property int $state 状态
 * @property int $newpm 新消息
 * @property int $email_state 邮箱验证状态
 * @property int $avatar_state 头像验证状态
 * @property int $auth_state 头像验证状态
 * @property int $freeze 冻结账户
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\UserAuth|null $auth
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $boughts
 * @property-read int|null $boughts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $cartItems
 * @property-read int|null $cart_items_count
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
 * @property-read string|null $avatar
 * @property-read array|string|null $state_des
 * @property-read \App\Models\UserGroup $group
 * @property-read \App\Models\UserProfile|null $info
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
 * @property-read \App\Models\UserStat|null $stat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscribe[] $subscribes
 * @property-read int|null $subscribes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatarState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNewpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $id
 * @property int $uid 会员ID
 * @property float $balance 账户余额
 * @property float $total_income 累计收入
 * @property float $total_cost 累计支出
 * @property int $points
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereTotalIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereUid($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemCollect
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string|null $title
 * @property string $image
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductItem|null $item
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollect whereUpdatedAt($value)
 */
	class ItemCollect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostTag
 *
 * @property int $tag_id
 * @property string $tag_name
 * @property int $tag_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagName($value)
 */
	class PostTag extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCollect whereUpdatedAt($value)
 */
	class PostCollect extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereAlbums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereUid($value)
 */
	class UserStat extends \Eloquent {}
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
 * @property-read \App\Models\PostCategory $catlog
 * @property-read int|null $comments_count
 * @property-read \App\Models\PostContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read mixed $state_des
 * @property-read mixed $type_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\PostMedia|null $media
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAllowcomment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFromurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereViews($value)
 */
	class PostItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemReviews
 *
 * @property int $id 主键
 * @property int $uid 用户
 * @property int $itemid 关联商品
 * @property int $trade_id 关联订单
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
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereAnony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereItemStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereServiceStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReview whereWuliuStar($value)
 */
	class ItemReviews extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserInfo
 *
 * @property int $uid
 * @property string|null $fullname
 * @property int $gender
 * @property string|null $birthday
 * @property int $blood
 * @property int $star
 * @property string|null $country
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $town
 * @property string|null $street
 * @property string|null $bio 个人简介
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUpdatedAt($value)
 */
	class UserInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $shop_id
 * @property string|null $name
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundAddress whereTel($value)
 */
	class RefundAddress extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockName($value)
 */
	class Block extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int $menuid
 * @property int $fid
 * @property string|null $name
 * @property string|null $url
 * @property string $type
 * @property string|null $icon
 * @property string $target
 * @property int $displayorder
 * @property int $available
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Menu $menu
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu available()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu onlyMenu()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereMenuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrl($value)
 */
	class Menu extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereOperate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUpdatedAt($value)
 */
	class UserLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostCatlog
 *
 * @property int $catid
 * @property int $fid 父级分类
 * @property string|null $name 分类名称
 * @property string|null $identifier
 * @property string $icon 图片
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property int $displayorder 显示顺序
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCategory[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\PostCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory enable()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereTemplateList($value)
 */
	class PostCatlog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAuth
 *
 * @property int $uid 用户ID
 * @property string|null $name 姓名
 * @property string|null $id_card_no 身份证号
 * @property string $id_card_front 身份证正面
 * @property string $id_card_back 身份证背面
 * @property string $id_card_hand 手持身份证
 * @property int $auth_state 认证状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereUpdatedAt($value)
 */
	class UserAuth extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Video
 *
 * @property int $id
 * @property string|null $title
 * @property string $image
 * @property string|null $content
 * @property string|null $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereUpdatedAt($value)
 */
	class Video extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveChat
 *
 * @property int $id
 * @property int|null $uid
 * @property int $live_id
 * @property string|null $message
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat whereLiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChat whereUpdatedAt($value)
 */
	class LiveChat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemCate
 *
 * @property int $id
 * @property int|null $itemid
 * @property int|null $catid
 * @property-read \App\Models\ProductCategory|null $catlog
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCate whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCate whereItemid($value)
 */
	class ItemCate extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCloseReason whereUpdatedAt($value)
 */
	class OrderCloseReason extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereValue($value)
 */
	class UserField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $itemid 商品ID
 * @property int $uid 用户ID
 * @property string|null $title 宝贝标题
 * @property string|null $subtitle 宝贝卖点
 * @property string|null $merchant_code 商品编号
 * @property string $thumb 商品缩略图
 * @property string $image 商品图片
 * @property float|null $price 商品售价
 * @property float|null $original_price 商品原价
 * @property float|null $redpack_amount 红包金额
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCate[] $cates
 * @property-read int|null $cates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCategory[] $catlogs
 * @property-read int|null $catlogs_count
 * @property-read \App\Models\ProductContent|null $content
 * @property-read \App\Models\FreightTemplate|null $freight
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read array|string|null $sale_state_des
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductProps[] $props
 * @property-read int|null $props_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductSku[] $skus
 * @property-read int|null $skus_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereFreightTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereIsBest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereIsdiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereMerchantCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereOnSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductItem whereViews($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefundReason
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundReason whereTitle($value)
 */
	class RefundReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserConnect
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property string|null $appid
 * @property string|null $platform 平台
 * @property string|null $unionid
 * @property string|null $openid 开放ID
 * @property string|null $nickname 昵称
 * @property int $gender 性别
 * @property string|null $city 城市
 * @property string|null $province 省，州
 * @property string|null $country 国籍
 * @property string|null $avatar 头像地址
 * @property \Illuminate\Support\Carbon|null $created_at 登录时间
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect miniProgram()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect officialAccount()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect wechatApp()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUpdatedAt($value)
 */
	class UserConnect extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChannel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChannel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChannel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChannel whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChannel whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveChannel whereName($value)
 */
	class LiveChannel extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaTitle($value)
 */
	class PostMedia extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemReviewsImage
 *
 * @property int $id
 * @property int $review_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductReviewImage whereThumb($value)
 */
	class ItemReviewsImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string|null $code 验证码
 * @property string|null $phone 手机号
 * @property string|null $email 邮箱
 * @property int $used 已使用
 * @property \Illuminate\Support\Carbon|null $created_at 发送时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereUsed($value)
 */
	class Verify extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUsername($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostComment
 *
 * @property int $cid
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereReplyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereReplyUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUsername($value)
 */
	class PostComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefundImage
 *
 * @property int $id
 * @property int $refund_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundImage whereThumb($value)
 */
	class RefundImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message query()
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemAttrValue
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttrValue query()
 */
	class ItemAttrValue extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereIsremote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereThumb($value)
 */
	class PostImage extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\District[] $childs
 * @property-read int|null $childs_count
 * @property-read \App\Models\District $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCitycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereUsetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereZoneCode($value)
 */
	class District extends \Eloquent {}
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
 * @property-read \App\Models\Page $category
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $h5_url
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page onlyPage()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page wherePageid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 */
	class Pages extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup systemGroups()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup userGroups()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereCreditshigher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereCreditslower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup wherePrivileges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereType($value)
 */
	class UserGroup extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUpdatedAt($value)
 */
	class PostLog extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereUsername($value)
 */
	class OrderLog extends \Eloquent {}
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
 * @property float $price 观看价格
 * @property int $state 状态
 * @property int $views 浏览量
 * @property \Illuminate\Support\Carbon|null $start_at 开始时间
 * @property \Illuminate\Support\Carbon|null $expires_at 过期时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\LiveChannel $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LiveChat[] $chats
 * @property-read int|null $chats_count
 * @property-read string|null $flv
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $h5_url
 * @property-read string|null $hls
 * @property-read string|null $hls_hd
 * @property-read string|null $hls_low
 * @property-read \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed $obs_push_url
 * @property-read string|null $obs_stream_name
 * @property-read string|null $push_url
 * @property-read mixed $state_des
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $url
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereIdPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereVideoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Live whereWatchMode($value)
 */
	class Live extends \Eloquent {}
}

