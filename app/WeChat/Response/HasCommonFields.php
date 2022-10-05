<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-05
 * Time: 21:31
 */

namespace App\WeChat\Response;


trait HasCommonFields
{
    /**
     * @return mixed
     */
    public function returnCode()
    {
        return $this->get('return_code');
    }

    /**
     * @return mixed
     */
    public function retrunMsg()
    {
        return $this->get('return_msg');
    }

    /**
     * @return mixed
     */
    public function appid()
    {
        return $this->get('appid');
    }

    /**
     * @return mixed
     */
    public function mchId()
    {
        return $this->get('mch_id');
    }

    /**
     * @return mixed
     */
    public function nonceStr()
    {
        return $this->get('nonce_str');
    }

    /**
     * @return mixed
     */
    public function sign()
    {
        return $this->get('sign');
    }

    /**
     * @return mixed
     */
    public function resultCode()
    {
        return $this->get('result_code');
    }

    /**
     * @return mixed
     */
    public function errCode()
    {
        return $this->get('err_code');
    }

    /**
     * @return mixed
     */
    public function errCodeDes()
    {
        return $this->get('err_code_des');
    }

    /**
     * @return bool
     */
    public function tradeSuccess()
    {
        return $this->resultCode() == 'SUCCESS';
    }
}
