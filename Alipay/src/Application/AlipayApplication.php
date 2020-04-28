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
 * Time: 1:22 上午
 */

namespace Alipay\Application;


abstract class AlipayApplication
{

    protected $charset = 'utf-8';
    protected $gateway = 'https://openapi.alipay.com/gateway.do';
    protected $rsaPrivateKey = '';
    protected $rsaPublicKey = '';

    protected $params = [
        'app_id' => '',
        'method' => '',
        'format' => 'json',
        'charset' => 'utf-8',
        'sign_type' => 'RSA2',
        'timestamp' => '',
        'version' => '1.0',
        'notify_url' => '',
        'return_url' => '',
        'biz_content' => ''
    ];

    /**
     * Alipay constructor.
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function __construct($config = [])
    {
        $config = array_merge(config('alipay.default'), $config);
        $this->rsaPrivateKey = $config['private_key'];
        $this->rsaPublicKey = $config['public_key'];
        $this->gateway .= '?charset=' . $this->charset;

        $this->params['app_id'] = $config['app_id'];
        $this->params['return_url'] = $config['return_url'];
        $this->params['notify_url'] = $config['notify_url'];
        $this->params['timestamp'] = date('Y-m-d H:i:s');

    }

    /**
     * @return string
     */
    protected function buildRequestForm()
    {
        $sHtml = '<!DOCTYPE html><html lang="zh"><head><title>Alipay</title></head><body>' . "\n";
        $sHtml .= "<form id='alipaysubmit' name='alipaysubmit' action='" . $this->gateway . "' method='POST'>\n";
        foreach ($this->params as $key => $val) {
            $val = str_replace("'", "&apos;", $val);
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>\n";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "</form>";
        $sHtml = $sHtml . "<script>document.getElementById('alipaysubmit').submit();</script></body></html>";

        return $sHtml;
    }


    protected function makeSign(){
        $this->prepareParams();
        $this->params['sign'] = $this->sign($this->buildParams($this->params));
    }

    protected function prepareParams()
    {
        foreach ($this->params as $k => $v) {
            if (is_numeric($k) || $v == null || $v == '') unset($this->params[$k]);
        }
    }

    /**
     * @param $params
     * @return string
     */
    protected function buildParams($params)
    {
        ksort($params);
        $newparams = [];
        foreach ($params as $key => $value) {
            $newparams[] = "$key=$value";
        }
        return implode('&', $newparams);
    }

    /**
     * @param $data
     * @return string
     */
    protected function rsaEncode($data)
    {
        $sign = '';
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($this->rsaPublicKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        openssl_public_encrypt($data, $sign, $publicKey);
        return $sign;
    }

    /**
     * @param $data
     * @return string|null
     */
    protected function sign($data)
    {
        $sign = null;
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($this->rsaPrivateKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        openssl_sign($data, $sign, $privateKey, OPENSSL_ALGO_SHA256);
        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * @param array $data
     * @param int $ssl
     * @param int $timeout
     * @return mixed
     */
    protected function curl($data = [], $ssl = false, $timeout = 500)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_URL, $this->gateway);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $ssl);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $ssl);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    /**
     * @param $data
     * @return array|mixed
     */
    public function postData($data){
        return json_decode($this->curl($data), true);
    }

    /**
     * @param mixed|string $appId
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->params['app_id'] = $appId;
        return $this;
    }

    /**
     * @param mixed|string $rsaPrivateKey
     * @return $this
     */
    public function setRsaPrivateKey($rsaPrivateKey)
    {
        $this->rsaPrivateKey = $rsaPrivateKey;
        return $this;
    }

    /**
     * @param mixed|string $rsaPublicKey
     * @return $this
     */
    public function setRsaPublicKey($rsaPublicKey)
    {
        $this->rsaPublicKey = $rsaPublicKey;
        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format)
    {
        $this->params['format'] = $format;
        return $this;
    }

    /**
     * @param string $charset
     * @return $this
     */
    public function setCharset(string $charset)
    {
        $this->charset = $charset;
        $this->params['charset'] = $charset;
        return $this;
    }

    /**
     * @param string $signType
     * @return $this
     */
    public function setSignType(string $signType)
    {
        $this->params['sign_type'] = $signType;
        return $this;
    }

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion(string $version)
    {
        $this->params['version'] = $version;
        return $this;
    }

    /**
     * @param mixed $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->params['method'] = $method;
        return $this;
    }

    /**
     * @param mixed|string $returnUrl
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        $this->params['return_url'] = $returnUrl;
        return $this;
    }

    /**
     * @param mixed|string $notifyUrl
     * @return $this
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->params['notify_url'] = $notifyUrl;
        return $this;
    }

    /**
     * @param array $bizContent
     * @return $this
     */
    protected function setBizContent(array $bizContent)
    {
        $this->params['biz_content'] = json_encode($bizContent, JSON_UNESCAPED_UNICODE);
        return $this;
    }
}
