<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/13
 * Time: 9:10 下午
 */

namespace ChinaPay\Content;


use ChinaPay\Exception\ChinaPayException;
use ChinaPay\SecssUtil;

abstract class ContentBuilder
{

    protected $secssUtil;
    protected $securityPropFile;

    protected $content = [
        'Version' => '20150922',
        'AccessType' => 0,
        'InstuId' => '',
        'AcqCode' => '',
        'MerId' => '',
        'TranType' => '',
        'BusiType' => '0001',
    ];

    /**
     * HasContent constructor.
     * @param array $contents
     */
    public function __construct(array $contents = [])
    {
        foreach ($contents as $k => $v) {
            if ($v == '' || $v == null) continue;
            $this->content[$k] = $v;
        }
        $this->secssUtil = new SecssUtil();
    }

    /**
     * @param $securityPropFile
     * @return $this
     * @throws ChinaPayException
     */
    public function setSecurityPropFile($securityPropFile)
    {
        $this->securityPropFile = $securityPropFile;
        if (!$this->secssUtil->init($securityPropFile)) {
            throw new ChinaPayException($this->secssUtil->getErrMsg(), $this->secssUtil->getErrCode());
        }
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setVersion($value)
    {
        $this->content['Version'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setAccessType($value)
    {
        $this->content['AccessType'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setInstuId($value)
    {
        $this->content['InstuId'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setAcqCode($value)
    {
        $this->content['AcqCode'] = $value;
        return $this;
    }

    /**
     * 设置商户ID
     * @param $value
     * @return $this
     */
    public function setMerId($value)
    {
        $this->content['MerId'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setTranType($value)
    {
        $this->content['TranType'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setBusiType($value)
    {
        $this->content['BusiType'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCardTranData($value)
    {
        $data = base64_encode(json_encode($value, JSON_UNESCAPED_UNICODE));
        if ($this->secssUtil->encryptData($data)){
            $this->content['CardTranData'] = $this->secssUtil->getEncValue();
        }
        //$this->content['CardTranData'] = json_encode($value, JSON_UNESCAPED_UNICODE);
        return $this;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        if (isset($this->content[$name])) return $this->content[$name];
        return null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        if (key_exists($name, $this->content)) {
            $this->content[$name] = $value;
        }
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->__set($name, $value);
        return $this;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        return $this->__get($name);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->content;
    }

    /**
     * @return array
     * @throws ChinaPayException
     */
    public function getBizContent()
    {
        foreach ($this->content as $k => $v) {
            if ($v == '' || $v == null) unset($this->content[$k]);
            if (is_array($v)) $this->content[$k] = json_encode($v, JSON_UNESCAPED_UNICODE);
        }
        if ($this->secssUtil->sign($this->content)) {
            $this->content['Signature'] = $this->secssUtil->getSign();
        } else {
            throw new ChinaPayException($this->secssUtil->getErrMsg(), $this->secssUtil->getErrCode());
        }
        return $this->content;
    }
}
