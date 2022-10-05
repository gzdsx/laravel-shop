<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/5/24
 * Time: 5:13 下午
 */

namespace App\WeChat\Notify;


abstract class Notify
{
    protected $content;

    public function __construct($content = [])
    {
        $this->content = collect($content);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->content->get($name);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->get($name);
    }

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

    /**
     * @return array
     */
    public function all()
    {
        return $this->content->toArray();
    }
}
