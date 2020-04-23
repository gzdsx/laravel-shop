<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/12
 * Time: 11:24 下午
 */

namespace ChinaPay\ElementQuery;


use ChinaPay\Content\ContentBuilder;

class ElementQueryContentBuilder extends ContentBuilder
{
    protected $content = [
        'Version' => '20150922',
        'AccessType' => 0,
        'InstuId' => '',
        'AcqCode' => '',
        'MerId' => '',
        'BusiType' => '0001',
        'TranType' => '0505',
        'OriTranType' => '0004',//9904 快捷签约,0004 快捷支付
        'OriBusiType' => '0001',//待查业务类型,固定值：0001
        'CardTranData' => '',//有卡交易信息域,JSON 格式填写,包含字段：CardNo：卡号
        'TranReserved' => '',
        'TimeStamp' => '',
        'RemoteAddr' => ''
    ];

    /**
     * @param $value
     * @return $this
     */
    public function setOriTranType($value)
    {
        $this->content['OriTranType'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCardTranData($value)
    {
        $this->content['CardTranData'] = $value;
        return $this;
    }
}
