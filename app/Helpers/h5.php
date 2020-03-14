<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/20
 * Time: 11:25 AM
 */

/**
 * @param $itemid
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function h5_item_url($itemid)
{
    return url('h5/item/detail/'.$itemid.'.html');
}

/**
 * @param $shop_id
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function h5_shop_url($shop_id)
{
    return url('h5/shop/viewshop/'.$shop_id.'.html');
}

/**
 * @param $aid
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function h5_post_url($aid)
{
    return url('h5/post/detail/'.$aid.'.html');
}

/**
 * @param $pageid
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function h5_page_url($pageid){
    return url('h5/pages/detail/'.$pageid.'.html');
}
