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
 * Time: 1:40 上午
 */

namespace Alipay\Builder;


abstract class AlipayContentBuilder
{
    protected $bizContent = [];

    /**
     * ContentBuilder constructor.
     * @param array $content
     */
    public function __construct($content = [])
    {
        $this->bizContent = $content;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        return isset($this->bizContent[$name]) ? $this->bizContent['name'] : null;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->bizContent[$name] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getBizContent()
    {
        foreach ($this->bizContent as $k => $v) {
            if ($v == '' || $v == null || is_numeric($k)) unset($this->bizContent[$k]);
        }

        return $this->bizContent;
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

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->get($name);
    }
}
