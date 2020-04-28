<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/28
 * Time: 1:49 上午
 */

namespace Alipay\Response;


abstract class AlipayResponse
{
    protected $response = [];

    /**
     * AlipayResponse constructor.
     * @param array $response
     */
    public function __construct($response = [])
    {
        $this->response = array_merge($this->response, $response);
    }

    /**
     * @return array
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * @return mixed|null
     */
    public function code()
    {
        return $this->get('msg');
    }

    /**
     * @return mixed|null
     */
    public function msg()
    {
        return $this->get('msg');
    }

    /**
     * @return mixed|null
     */
    public function subCode()
    {
        return $this->get('sub_code');
    }

    /**
     * @return mixed|null
     */
    public function subMsg()
    {
        return $this->get('sub_msg');
    }

    /**
     * @return mixed|null
     */
    public function sign()
    {
        return $this->get('sign');
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        return isset($this->response[$name]) ? $this->response[$name] : null;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->response[$name] = $value;
        return $this;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->get($name);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        return $this->set($name, $value);
    }
}
