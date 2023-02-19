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
 * App\Models\AdminGroup
 *
 * @property int $gid 主键
 * @property string|null $name 名称
 * @property int $sort_num 序号
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminUser[] $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup whereSortNum($value)
 */
	class AdminGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdminUser
 *
 * @property int $id 主键
 * @property int|null $uid 用户ID
 * @property int|null $gid 分组ID
 * @property string|null $privileges 权限
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\AdminGroup|null $group
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser wherePrivileges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereUpdatedAt($value)
 */
	class AdminUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonAd
 *
 * @property int $id ID
 * @property int $uid 用户ID
 * @property string|null $title 标题
 * @property string $type 类型
 * @property array|null $data 内容
 * @property int $clicks 点击数
 * @property int $available 是否可用
 * @property \Illuminate\Support\Carbon|null $begin_at 生效日期
 * @property \Illuminate\Support\Carbon|null $end_at 失效日期
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read array|string|null $state_des
 * @property-read mixed|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonAd whereUpdatedAt($value)
 */
	class CommonAd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Block
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommonBlockItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock whereName($value)
 */
	class CommonBlock extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonBlockItem
 *
 * @property int $id 主键
 * @property int $block_id 块ID
 * @property string|null $title 标题
 * @property string $image 图片
 * @property string|null $url 链接
 * @property string|null $subtitle 副标题
 * @property string|null $field_1
 * @property string|null $field_2
 * @property string|null $field_3
 * @property int|null $sort_num 显示顺序
 * @property-read \App\Models\CommonBlock|null $block
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockItem whereUrl($value)
 */
	class CommonBlockItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonDistrict
 *
 * @property int $id ID
 * @property int $parent_id 父级ID
 * @property string|null $name 名称
 * @property string|null $fullname 全称
 * @property int $level 级别
 * @property float|null $lng 经度
 * @property float|null $lat 纬度
 * @property string|null $pinyin 拼音
 * @property string|null $letter 首字母
 * @property string|null $zonecode 区位代码
 * @property string|null $citycode 区号
 * @property string|null $zipcode 邮编
 * @property int $sort_num 排序
 * @property-read \Illuminate\Database\Eloquent\Collection|CommonDistrict[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|CommonDistrict[] $childs
 * @property-read int|null $childs_count
 * @property-read CommonDistrict|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereCitycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonDistrict whereZonecode($value)
 */
	class CommonDistrict extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonExpress
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $regular
 * @property int $sort_num
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereRegular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereSortNum($value)
 */
	class CommonExpress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonFeedback
 *
 * @property int $id 主键
 * @property int $uid 管理用户
 * @property string|null $title 标题
 * @property string|null $message 内容
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUpdatedAt($value)
 */
	class CommonFeedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonJPush
 *
 * @property int $id
 * @property int|null $uid
 * @property string|null $appid
 * @property string|null $ios
 * @property string|null $android
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush android()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush ios()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush whereAndroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush whereIos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonJPush whereUid($value)
 */
	class CommonJPush extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonKefu
 *
 * @property int $id 主键
 * @property string|null $title 标题
 * @property string|null $phone 电话
 * @property string|null $weixin 微信
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereWeixin($value)
 */
	class CommonKefu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonLabel
 *
 * @property int $id 主键
 * @property string|null $title 名称
 * @property string|null $content 内容
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereUpdatedAt($value)
 */
	class CommonLabel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonLink
 *
 * @property int $id 主键
 * @property int $cate_id 分类ID
 * @property string $type 类型
 * @property string|null $title 标题
 * @property string|null $url 链接
 * @property string $image 图片
 * @property string|null $description 描述
 * @property int $sort_num 排序
 * @property-read CommonLink|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|CommonLink[] $links
 * @property-read int|null $links_count
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink onlyCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink onlyLink()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLink whereUrl($value)
 */
	class CommonLink extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonMaterial
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
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial doc()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial file()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial image()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial video()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial voice()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMaterial whereWidth($value)
 */
	class CommonMaterial extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonMenu
 *
 * @property int $id 主键
 * @property string|null $name 名称
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommonMenuItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommonMenuItem[] $visibleItems
 * @property-read int|null $visible_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenu whereName($value)
 */
	class CommonMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonMenuItem
 *
 * @property int $id 主键
 * @property int $menu_id 菜单ID
 * @property int $parent_id 父级ID
 * @property string|null $title 名称
 * @property string|null $url 链接
 * @property string $image 图片
 * @property string $target 目标
 * @property int $hide 是否隐藏
 * @property int $sort_num 显示序号
 * @property-read \Illuminate\Database\Eloquent\Collection|CommonMenuItem[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\CommonMenu|null $menu
 * @property-read CommonMenuItem|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonMenuItem whereUrl($value)
 */
	class CommonMenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CommonSetting
 *
 * @property string $skey 标识
 * @property string|null $svalue 值
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting whereSkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting whereSvalue($value)
 */
	class CommonSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomCart
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $shop_id 店铺ID
 * @property int $itemid 产品ID
 * @property string|null $title 产品标题
 * @property int $quantity 产品数量
 * @property string $price 商品价格
 * @property string $thumb 缩略图
 * @property string $image 大图
 * @property int $sku_id SKU ID
 * @property string|null $sku_title SKU名称
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \App\Models\EcomProductItem|null $product
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \App\Models\EcomProductSku|null $sku
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomCart whereUpdatedAt($value)
 */
	class EcomCart extends \Eloquent {}
}

namespace App\Models{
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
 */
	class EcomCartShop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductAttr
 *
 * @property int $attr_cate_id 属性分类ID
 * @property string|null $attr_title 属性名称
 * @property int $shop_id 门店ID
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductAttrValue[] $attrValues
 * @property-read int|null $attr_values_count
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttr newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttr newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttr query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttr whereAttrCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttr whereAttrTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttr whereShopId($value)
 */
	class EcomProductAttr extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductAttrValue
 *
 * @property int $attr_id 属性ID
 * @property string|null $attr_value 属性值
 * @property int $attr_cate_id 分类ID
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue whereAttrCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue whereAttrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductAttrValue whereAttrValue($value)
 */
	class EcomProductAttrValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductCategory
 *
 * @property int $cate_id 主键
 * @property string|null $cate_name 分类名称
 * @property int $parent_id 父级分类
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $level 级别
 * @property int $available 是否可用
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property int $sort_num 显示顺序
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|EcomProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|EcomProductCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read EcomProductCategory|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|EcomProductCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductCategory whereTemplateList($value)
 */
	class EcomProductCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductClassify
 *
 * @property int $cate_id 分类ID
 * @property string|null $cate_name 分类名称
 * @property int $shop_id 店铺ID
 * @property int $parent_id 父级ID
 * @property int $sort_num 显示顺序
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductClassify whereSortNum($value)
 */
	class EcomProductClassify extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductContent
 *
 * @property int $itemid 产品ID
 * @property string|null $content 产品详情
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductContent whereItemid($value)
 */
	class EcomProductContent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductGroup
 *
 * @property int $group_id 主键
 * @property int $uid 团长ID
 * @property int $itemid 产品ID
 * @property int $order_id 订单ID
 * @property int $num 需求人数
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductGroupItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\EcomProductItem|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroup whereUpdatedAt($value)
 */
	class EcomProductGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductGroupItem
 *
 * @property int $id 主键
 * @property int $group_id 团ID
 * @property int $uid 用户ID
 * @property int|null $itemid 产品ID
 * @property int|null $order_id 订单ID
 * @property int $is_chief 是否团长
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property-read \App\Models\EcomProductGroup|null $group
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereIsChief($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductGroupItem whereUpdatedAt($value)
 */
	class EcomProductGroupItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductImage
 *
 * @property int $id 主键
 * @property int $itemid 产品
 * @property string $thumb 小图
 * @property string $image 大图
 * @property int $sort_num 显示顺序
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductImage whereThumb($value)
 */
	class EcomProductImage extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductCategory[] $bgCates
 * @property-read int|null $bg_cates_count
 * @property-read \App\Models\EcomProductCategory|null $category
 * @property-read \App\Models\EcomProductContent|null $content
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read array|string|null $state_des
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $subscribedUsers
 * @property-read int|null $subscribed_users_count
 * @property-read \App\Models\EcomProductTemplate|null $template
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereCollectCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereFreeDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereHasSkuAttr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsPromotion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereIsRaffle($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereRedpackAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereReviewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductItem whereViews($value)
 */
	class EcomProductItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductProps
 *
 * @property int $id 主键
 * @property int $itemid 产品ID
 * @property int $prop_id 属性ID
 * @property string|null $prop_name 属性名称
 * @property string|null $prop_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps wherePropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps wherePropName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductProps wherePropValue($value)
 */
	class EcomProductProps extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductReview
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductReviewImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\EcomProductItem|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereAnony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereItemStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereServiceStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReview whereWuliuStar($value)
 */
	class EcomProductReview extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductReviewImage
 *
 * @property int $id
 * @property int $review_id
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductReviewImage whereThumb($value)
 */
	class EcomProductReviewImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductSku
 *
 * @property int $sku_id SKU ID
 * @property int $itemid 商品ID
 * @property string|null $title SKU名称
 * @property string|null $image 图片
 * @property string $price 价格
 * @property string $pin_price 品团价
 * @property int $stock 库存
 * @property string|null $code SKU编码
 * @property string|null $properties 属性组合
 * @property-read \App\Models\EcomProductItem|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku wherePinPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductSku whereTitle($value)
 */
	class EcomProductSku extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomProductTemplate
 *
 * @property int $template_id 模板ID
 * @property int $shop_id 店铺ID
 * @property string|null $template_name 模板名称
 * @property string|null $template_info 描述
 * @property int $valuation 计价方式
 * @property int $start_quantity 默认数量
 * @property string $start_fee 默认运费
 * @property int $growth_quantity 递增数量
 * @property string $growth_fee 递增运费
 * @property string|null $delivery_areas 配送区域
 * @property string $free_amount 包邮金额
 * @property int $free_quantity 包邮数量
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereDeliveryAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereFreeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereFreeQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereGrowthFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereGrowthQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereStartFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereStartQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereTemplateInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomProductTemplate whereValuation($value)
 */
	class EcomProductTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomShop
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
 * @property \Illuminate\Support\Carbon|null $created_at 开店时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\EcomShopCertify|null $certify
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductClassify[] $classifies
 * @property-read int|null $classifies_count
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $auth_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $bond_state_des
 * @property-read string $formatted_address
 * @property-read string $state_des
 * @property-read string|null $we_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomShopImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductAttr[] $productAttrs
 * @property-read int|null $product_attrs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $seller
 * @property-read \App\Models\EcomShopStats|null $stats
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $subscribedUsers
 * @property-read int|null $subscribed_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop opening()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereBondState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereCumulativeSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereIsPayReduceStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereIsRefundRollbackStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereIsSevenRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereLastReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereMonthSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereNewProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereSubscribeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShop whereWeixin($value)
 */
	class EcomShop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomShopCertify
 *
 * @property int $id 主键
 * @property int $shop_id 店铺ID
 * @property string|null $name 店主姓名
 * @property string|null $id_card_no 店主身份证号
 * @property string|null $id_card_front 身份证正面照
 * @property string|null $id_card_back 身份证背面照
 * @property string|null $id_card_hand 手持身份证照
 * @property string|null $license_pic 营业执照照片
 * @property string|null $other_pic 其它证件照片
 * @property string|null $scope 经营范围
 * @property int $state 审核状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereLicensePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereOtherPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopCertify whereUpdatedAt($value)
 */
	class EcomShopCertify extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomShopImage
 *
 * @property int $id 主键
 * @property int $shop_id 门店ID
 * @property string|null $thumb 小图
 * @property string $image 图片
 * @property int $sort_num 排序
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopImage whereThumb($value)
 */
	class EcomShopImage extends \Eloquent {}
}

namespace App\Models{
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
 */
	class EcomShopSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomShopStats
 *
 * @property int $id 主键
 * @property int $shop_id 店铺ID
 * @property string $day_turnover 日营业额
 * @property string $month_turnover 月营业额
 * @property string $total_turnover 总营业额
 * @property int $day_sales 日销量
 * @property int $month_sales 月销量
 * @property int $total_sales 总销量
 * @property int $day_visitors 日访客
 * @property int $month_visitors 月访客
 * @property int $total_visitors 总访客
 * @property-read \App\Models\EcomShop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereDaySales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereDayTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereDayVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereMonthSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereMonthTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereMonthVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereTotalSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereTotalTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EcomShopStats whereTotalVisitors($value)
 */
	class EcomShopStats extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection|static[] all($columns = ['*'])
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification read()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification unread()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $order_id 主键
 * @property string|null $order_no 订单编号
 * @property int $order_type 订单类型,1=普通订单,2=拼单,3=超市订单,4=外卖订单
 * @property int $order_state 订单状态:0=待付款,1=待发货,2=待收货,3=已收货,10=退款中,20=已取消
 * @property int $shop_id 门店ID
 * @property string|null $shop_name 门店名称
 * @property int $buyer_id 买家ID
 * @property string|null $buyer_name 买家账号
 * @property string|null $remark 买家留言
 * @property int $seller_id 卖家ID
 * @property string|null $seller_name 卖家账号
 * @property string $product_fee 商品总价
 * @property string $shipping_fee 配送费
 * @property string $box_fee 餐盒费
 * @property string $total_fee 订单总额
 * @property string $discount_fee 优惠金额
 * @property string $order_fee 实付金额
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
 * @property int $cancel_state 取消状态
 * @property \Illuminate\Support\Carbon|null $cancel_at 取消时间
 * @property string|null $cancel_reason 取消原因
 * @property int $accept_state 受理状态
 * @property \Illuminate\Support\Carbon|null $accept_at 受理时间
 * @property int $refund_state 退款状态
 * @property \Illuminate\Support\Carbon|null $refund_at 退款时间
 * @property int $buyer_deleted 买家已删除
 * @property int $seller_deleted 卖家已删除
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $buyer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDiscount[] $discounts
 * @property-read int|null $discounts_count
 * @property-read mixed|null $buyer_state_des
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $seller_state_des
 * @property-read mixed|null $state_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Refund[] $refunds
 * @property-read int|null $refunds_count
 * @property-read \App\Models\User|null $seller
 * @property-read \App\Models\OrderShipping|null $shipping
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \App\Models\UserTransaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|Order filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAcceptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAcceptState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBoxFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelState($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSellerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSellerRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDiscount
 *
 * @property int $id 主键
 * @property int $order_id 订单ID
 * @property string|null $title 名称
 * @property string $amount 减免金额
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereTitle($value)
 */
	class OrderDiscount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderItem
 *
 * @property int $trade_id 主键
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property string|null $title 商品名称
 * @property string $price 商品价格
 * @property int $quantity 商品数量
 * @property string $image 商品图片
 * @property int|null $sku_id 属性ID
 * @property string|null $sku_title 商品属性
 * @property int $is_gift 是否赠品
 * @property int $type 商品类型
 * @property-read float|int $total_fee
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\Refund|null $refund
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereIsGift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSkuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereType($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderLog
 *
 * @property int $id
 * @property int $order_id 订单ID
 * @property int $uid 操作用户ID
 * @property string|null $username
 * @property string|null $content 操作内容
 * @property \Illuminate\Support\Carbon|null $created_at 操作时间
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order|null $order
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
 * @property int $id 主键
 * @property int $order_id 订单ID
 * @property string|null $express_code 快递公司编号
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $phone 联系电话
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $street 街道
 * @property float $latitude 纬度
 * @property float $longitude 经度
 * @property string|null $postalcode 邮政编码
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read string $formatted_address
 * @property-read \App\Models\Order|null $order
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
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShipping whereUpdatedAt($value)
 */
	class OrderShipping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id 页面ID
 * @property int $cate_id 分类ID
 * @property string|null $title 标题
 * @property string|null $alias 别名
 * @property string $image 图片
 * @property string|null $content 内容
 * @property string|null $template 模板
 * @property int $sort_num 显示顺序
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\PageCategory|null $category
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $m_url
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PageCategory
 *
 * @property int $cate_id 分类ID
 * @property string|null $cate_name 分类名称
 * @property int $sort_num 显示顺序
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|PageCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCategory whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageCategory whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageCategory whereSortNum($value)
 */
	class PageCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostCategory
 *
 * @property int $cate_id 主键
 * @property string|null $cate_name 分类名称
 * @property int $parent_id 父级分类
 * @property string|null $identifier 标识
 * @property string $image 图片
 * @property int $level 级别
 * @property int $available 是否可用
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property int $sort_num 显示顺序
 * @property string|null $template_index 首页模板
 * @property string|null $template_list 列表页模板
 * @property string|null $template_detail 详细页模板
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-read PostCategory|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PostCategory[] $siblings
 * @property-read int|null $siblings_count
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTemplateList($value)
 */
	class PostCategory extends \Eloquent {}
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
 * @property-read \App\Models\PostItem|null $post
 * @property-read \App\Models\User|null $user
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
 * @property int $sort_num
 * @property-read \App\Models\PostItem|null $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereSortNum($value)
 */
	class PostContent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostImage
 *
 * @property int $id
 * @property int $aid 数据ID
 * @property string $thumb
 * @property string $image
 * @property int $isremote
 * @property string|null $description
 * @property int $displayorder
 * @property-read \App\Models\PostItem|null $post
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
 * @property int $cate_id 分类ID
 * @property string|null $author 作者
 * @property string|null $type 文章形式
 * @property string|null $title 文章标题
 * @property string|null $alias 别名
 * @property string|null $summary 摘要
 * @property string $image 图片
 * @property array|null $tags 标签
 * @property int $allowcomment 允许评论
 * @property int $collect_count 被收藏数
 * @property int $comment_count 评论数
 * @property int $like_count 点赞数
 * @property int $views 浏览数
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
 * @property-read \App\Models\PostCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $comments
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $subscribedUsers
 * @property-read int|null $subscribed_users_count
 * @property-read \App\Models\User|null $user
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
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereClick7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCollectCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCommentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereFromurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|PostItem whereLikeCount($value)
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
 * @property int $id 主键
 * @property int $aid 文章ID
 * @property int $uid 用户ID
 * @property string|null $content 内容
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\PostItem|null $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostLog whereId($value)
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
 * @property-read \App\Models\PostItem|null $post
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
 * @property int $id
 * @property string $name
 * @property int $total
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTotal($value)
 */
	class PostTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Refund
 *
 * @property int $refund_id 主键
 * @property int $trade_id 订单ID
 * @property int $uid 用户ID
 * @property string|null $refund_no 退款单号
 * @property int $refund_type 退货类型,1=仅退款,2=退货退款
 * @property int $refund_state 处理状态
 * @property string|null $refund_reason 退货原因
 * @property string|null $refund_desc 退款说明
 * @property string $refund_amount 退款金额
 * @property string|null $refund_remark 备注
 * @property string $shipping_fee 退货运费
 * @property int $goods_state 货物状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $goods_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $refund_state_des
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $refund_type_des
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Order|null $order
 * @property-read Refund|null $refund
 * @property-read \App\Models\RefundShipping|null $shipping
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Refund filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereGoodsState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUpdatedAt($value)
 */
	class Refund extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EcomRefundAddress
 *
 * @property-read string $formatted_address
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundAddress query()
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
 * @property int|null $sort_num
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundReason whereTitle($value)
 */
	class RefundReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefundShipping
 *
 * @property int $id 主键
 * @property int $refund_id 订单ID
 * @property string|null $express_code 快递编码
 * @property string|null $express_name 快递名称
 * @property string|null $express_no 快递单号
 * @property string|null $name 联系人
 * @property string|null $phone 联系电话
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $street 街道
 * @property string|null $postalcode 邮编
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read string $formatted_address
 * @property-read \App\Models\Refund|null $refund
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
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundShipping whereUpdatedAt($value)
 */
	class RefundShipping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $uid 主键
 * @property int $gid 管理权限
 * @property string|null $nickname 昵称
 * @property string|null $phone 手机号
 * @property string|null $email 邮箱
 * @property string|null $avatar 头像
 * @property int $credits 积分
 * @property string|null $password 密码
 * @property string|null $remember_token
 * @property int $email_state 邮箱验证状态
 * @property int $avatar_state 头像验证状态
 * @property int $auth_state 实名认证状态
 * @property int $freeze 冻结
 * @property float $latitude 纬度
 * @property float $longitude 经度
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\UserAccount|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\AdminUser|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $boughts
 * @property-read int|null $boughts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomCart[] $cartProducts
 * @property-read int|null $cart_products_count
 * @property-read \App\Models\UserCertify|null $certify
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserCommissionLog[] $commissionLogs
 * @property-read int|null $commission_logs_count
 * @property-read User|null $commonlyTransferUsers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserConnect[] $connects
 * @property-read int|null $connects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserEducation[] $educations
 * @property-read int|null $educations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $fans
 * @property-read int|null $fans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserField[] $fields
 * @property-read int|null $fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $follows
 * @property-read int|null $follows_count
 * @property-read array|string|null $state_des
 * @property-read \App\Models\UserGroup|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommonMaterial[] $materials
 * @property-read int|null $materials_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserPosition[] $positions
 * @property-read int|null $positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \App\Models\EcomShop|null $shop
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $solds
 * @property-read int|null $solds_count
 * @property-read \App\Models\UserStats|null $stats
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $subscribedPosts
 * @property-read int|null $subscribed_posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomProductItem[] $subscribedProducts
 * @property-read int|null $subscribed_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EcomShop[] $subscribedShops
 * @property-read int|null $subscribed_shops_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserTransaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserTransferCommonly[] $transferCommonly
 * @property-read int|null $transfer_commonly_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserWithrawalLog[] $withdrawalLogs
 * @property-read int|null $withdrawal_logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|User filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $uid 会员ID
 * @property string|null $password 支付密码
 * @property string $balance 账户余额
 * @property string $freeze 冻结金额
 * @property string $total_income 累计收入
 * @property string $total_cost 累计支出
 * @property int $points 积分
 * @property int $coins 金币
 * @property int $freeze_coins 冻结金币
 * @property string $commission 佣金
 * @property string $cumulative_commission 累计佣金
 * @property string $withdrawal_commission 成功提现佣金
 * @property float $reward 奖励
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereCumulativeCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereFreezeCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereTotalIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereWithdrawalCommission($value)
 */
	class UserAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $tag 标签
 * @property string|null $name 姓名
 * @property string|null $phone 电话
 * @property int $gender 性别
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 区县
 * @property string|null $street 详细地址
 * @property float $latitude 纬度
 * @property float $longitude 经度
 * @property string|null $postalcode 邮编
 * @property int $isdefault 是否默认地址
 * @property-read string $formatted_address
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereTag($value)
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
 * @property string|null $id_card_no 身份证号
 * @property string|null $id_card_front 身份证正面
 * @property string|null $id_card_back 身份证背面
 * @property string|null $id_card_hand 手持身份证
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereUpdatedAt($value)
 */
	class UserCertify extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserCommissionLog
 *
 * @property-read \App\Models\User|null $payer
 * @method static \Illuminate\Database\Eloquent\Builder|UserCommissionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCommissionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCommissionLog query()
 */
	class UserCommissionLog extends \Eloquent {}
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
 * @property-read \App\Models\User|null $user
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
 * App\Models\UserEducation
 *
 * @property int $id 主键
 * @property int|null $uid 用户ID
 * @property string|null $school_name 学校名称
 * @property string|null $degree_name 学位名称
 * @property string|null $field_of_study_name 专业名称
 * @property \Illuminate\Support\Carbon|null $start_at 入学时间
 * @property \Illuminate\Support\Carbon|null $end_at 毕业时间
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereDegreeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereFieldOfStudyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEducation whereUpdatedAt($value)
 */
	class UserEducation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserFans
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $fans_id 粉丝ID
 * @property \Illuminate\Support\Carbon|null $created_at 关注时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \App\Models\User|null $fans
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans whereFansId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFans whereUpdatedAt($value)
 */
	class UserFans extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserField
 *
 * @property int $id
 * @property int $uid
 * @property string|null $name
 * @property string|null $value
 * @property-read \App\Models\User|null $user
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
 * @property int $gid 主键
 * @property string|null $name 名称
 * @property int $credits 积分下限
 * @property string|null $memo 备注
 * @property array|null $privileges 权限
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGroup wherePrivileges($value)
 */
	class UserGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserJobIntention
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $position_name 职位名称
 * @property string|null $work_place 工作地点
 * @property int $job_type 求职类型
 * @property-read mixed $job_type_name
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereJobType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserJobIntention whereWorkPlace($value)
 */
	class UserJobIntention extends \Eloquent {}
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
 * @property-read \App\Models\User|null $user
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
 * App\Models\UserPosition
 *
 * @property int $id 主键
 * @property int $uid 关联用户
 * @property string|null $company_name 公司名称
 * @property string|null $position_name 职位名称
 * @property string|null $geo_location_name 工作地点
 * @property string|null $industry_name 行业名称
 * @property \Illuminate\Support\Carbon|null $start_at 入职时间
 * @property \Illuminate\Support\Carbon|null $end_at 离职时间
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed $years
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereGeoLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereIndustryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPosition whereUpdatedAt($value)
 */
	class UserPosition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPrepay
 *
 * @property int $id 主键
 * @property int $uid 付款人ID
 * @property int $payable_id 关联类型ID
 * @property string $out_trade_no 单号
 * @property string|null $prepay_id 微信支付prepay_id
 * @property array|null $data 支付数据
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay wherePayableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay wherePrepayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrepay whereUpdatedAt($value)
 */
	class UserPrepay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserInfo
 *
 * @property int $uid 用户ID
 * @property string|null $firstname 名
 * @property string|null $lastname 姓
 * @property int $gender 性别
 * @property \Illuminate\Support\Carbon|null $birthday 生日
 * @property int $age 年龄
 * @property float|null $height 身高
 * @property float|null $weight 体重
 * @property string|null $education 学历
 * @property int $blood 血型
 * @property int $star 星座
 * @property string|null $weixin 微信号
 * @property string|null $country 国籍
 * @property string|null $province 省
 * @property string|null $city 市
 * @property string|null $district 县
 * @property string|null $town 乡镇
 * @property string|null $street 街道
 * @property string|null $bio 个人简介
 * @property \Illuminate\Support\Carbon|null $start_work_at 参加工作时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed $fullname
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $gender_des
 * @property-read mixed $work_years
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStartWorkAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereWeixin($value)
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserStat
 *
 * @property int $uid 用户ID
 * @property int $fans 粉丝数
 * @property int $follows 关注数
 * @property int $likes 获赞数
 * @property int $posts 文章数
 * @property int $videos 视频数
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereFans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereFollows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStats whereVideos($value)
 */
	class UserStats extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserTransaction
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property int $type 交易类型:1=收入,2=支出
 * @property int $account_type 财务类型
 * @property string|null $out_trade_no 交易流水
 * @property string|null $pay_type 支付方式
 * @property int $pay_state 支付状态,0=未支付，1=已支付
 * @property \Illuminate\Support\Carbon|null $pay_at 付款时间
 * @property string|null $detail 交易说明
 * @property string $amount 交易金额
 * @property string|null $memo 交易备注
 * @property array|null $data 付款信息
 * @property int $other_account_id 对方账户ID
 * @property string|null $other_account_name 对方账户名称
 * @property \Illuminate\Support\Carbon|null $created_at 交易时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read mixed|null $pay_state_des
 * @property-read mixed|null $pay_type_des
 * @property-read mixed|null $type_des
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User|null $otherAccount
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereOtherAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereOtherAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction wherePayState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransaction whereUpdatedAt($value)
 */
	class UserTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserTransferCommonly
 *
 * @property int $id
 * @property int $uid
 * @property int $payee_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly wherePayeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly whereUid($value)
 */
	class UserTransferCommonly extends \Eloquent {}
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
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereUsed($value)
 */
	class UserVerify extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserWithrawalLog
 *
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $state_des
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserWithrawalLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWithrawalLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWithrawalLog query()
 */
	class UserWithrawalLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WxLogin
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $basestr 秘钥
 * @property string|null $openid openid
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \App\Models\User|null $user
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
 * @property int $id 主键
 * @property int $parent_id 父级ID
 * @property string|null $name 菜单名称
 * @property string|null $type 菜单类型
 * @property string|null $key key
 * @property string|null $media_id 素材ID
 * @property string|null $url 跳转链接
 * @property string|null $appid 小程序appid
 * @property string|null $pagepath 小程序页面路径
 * @property int $sort_num 排序
 * @property-read \Illuminate\Database\Eloquent\Collection|WechatMenu[] $children
 * @property-read int|null $children_count
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu wherePagepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereSortNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatMenu whereUrl($value)
 */
	class WechatMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WechatSession
 *
 * @property int $id
 * @property string|null $openid
 * @property string|null $unionid
 * @property string|null $session_key
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereSessionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereUnionid($value)
 */
	class WechatSession extends \Eloquent {}
}

