<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/3/24
 * Time: 00:49
 */

namespace App\Traits\Ecom;


use App\Models\EcomProductTemplate;

trait HasFreight
{
    /**
     * 计算运费
     * @param $template_id
     * @param $quantity
     * @param $amount
     * @return float|\Illuminate\Support\HigherOrderCollectionProxy|int|mixed|string
     */
    protected function computeFreight($template_id, $quantity, $amount)
    {
        $freight = 0;
        $template = EcomProductTemplate::find($template_id);
        if ($template) {
            if ($quantity >= $template->free_quantity || $amount >= $template->free_amount){
                return $freight;
            }

            $freight = $template->start_fee;
            if ($quantity > $template->start_quantity) {
                $freight += ceil(($quantity - $template->start_quantity) / $template->growth_quantity) * $template->growth_fee;
            }
        }

        return $freight;
    }
}
