<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/6/14
 * Time: 下午5:49
 */

namespace App\Alipay;

use App\Alipay\Response\AlipayTradeQueryResponse;

class AlipayClient
{
    private $appId = '';
    private $rsaPrivateKey = '';
    private $rsaPublicKey = '';
    private $format = 'json';
    private $charset = 'utf-8';
    private $signType = 'RSA2';
    private $gateway = 'https://openapi.alipay.com/gateway.do';
    private $version = '1.0';

    private $returnUrl = '';
    private $notifyUrl = '';

    /**
     * Alipay constructor.
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function __construct($config = [])
    {
        $this->appId = $config['appid'] ?? config('alipay.default.appid');
        $this->rsaPrivateKey = $config['private_key'] ?? config('alipay.default.private_key');
        $this->rsaPublicKey = $config['public_key'] ?? config('alipay.default.public_key');
        $this->returnUrl = $config['return_url'] ?? config('alipay.default.return_url');
        $this->notifyUrl = $config['notify_url'] ?? config('alipay.default.notify_url');
        $this->gateway .= '?charset=' . $this->charset;
    }

    /**
     * 网页支付
     * @param $payContent
     * @return string
     */
    public function webPay($payContent)
    {
        if (is_object($payContent)) {
            $payContent->product_code = 'FAST_INSTANT_TRADE_PAY';
        } else {
            $payContent['product_code'] = 'FAST_INSTANT_TRADE_PAY';
        }

        $params = [
            'app_id' => $this->appId,
            'method' => 'alipay.trade.page.pay',
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->signType,
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => $this->version,
            'return_url' => $this->returnUrl,
            'notify_url' => $this->notifyUrl,
            'biz_content' => json_encode($payContent, JSON_UNESCAPED_UNICODE)
        ];

        $params = $this->prepareParams($params);
        $params['sign'] = $this->sign($this->buildParams($params));

        return $this->buildRequestForm($params);
    }

    /**
     * @param $params
     * @return string
     */
    private function buildRequestForm($params)
    {
        $sHtml = '<!DOCTYPE html><html><head><title>Alipay</title></head><body>' . "\n";
        $sHtml .= "<form id='alipaysubmit' name='alipaysubmit' action='" . $this->gateway . "' method='POST'>\n";
        foreach ($params as $key => $val) {
            $val = str_replace("'", "&apos;", $val);
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>\n";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "<input type='submit' value='ok' style='display:none;'></form>";
        $sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script></body></html>";

        return $sHtml;
    }

    /**
     * App 支付, 必填参数：subject, out_trade_no, total_amount,
     * @param $payContent
     * @return array
     */
    public function appPay($payContent)
    {
        if (is_object($payContent)) {
            $payContent->product_code = 'QUICK_MSECURITY_PAY';
        } else {
            $payContent['product_code'] = 'QUICK_MSECURITY_PAY';
        }

        $params = [
            'app_id' => $this->appId,
            'method' => 'alipay.trade.app.pay',
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->signType,
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => $this->version,
            'notify_url' => $this->notifyUrl,
            'biz_content' => json_encode($payContent, JSON_UNESCAPED_UNICODE)
        ];

        $params = $this->prepareParams($params);
        $params['sign'] = $this->sign($this->buildParams($params));
        return $params;
    }

    /**
     * 订单查询, 参数:trade_no||out_trade_no
     * @param $payContent
     * @return AlipayTradeQueryResponse
     */
    public function query($payContent)
    {
        $params = [
            'app_id' => $this->appId,
            'method' => 'alipay.trade.query',
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->signType,
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => $this->version,
            'biz_content' => json_encode($payContent, JSON_UNESCAPED_UNICODE)
        ];

        $params = $this->prepareParams($params);
        $params['sign'] = $this->sign($this->buildParams($params));
        $response = json_decode($this->curl($params), true);
        return (new AlipayTradeQueryResponse())->data($response['alipay_trade_query_response']);
    }

    /**
     * 关闭订单, 参数:trade_no||out_trade_no
     * @param $payContent
     * @return
     */
    public function close($payContent)
    {
        $params = [
            'app_id' => $this->appId,
            'method' => 'alipay.trade.close',
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->signType,
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => $this->version,
            'notify_url' => $this->notifyUrl,
            'biz_content' => json_encode($payContent, JSON_UNESCAPED_UNICODE)
        ];

        $params = $this->prepareParams($params);
        $params['sign'] = $this->sign($this->buildParams($params));
        $response = json_decode($this->curl($params), true);
        return $response;
    }

    /**
     * 退款, 必填参数:trade_no||out_trade_no
     * @param $payContent
     * @return mixed
     */
    public function refund($payContent)
    {
        $params = [
            'app_id' => $this->appId,
            'method' => 'alipay.trade.refund',
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->signType,
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => $this->version,
            'biz_content' => json_encode($payContent, JSON_UNESCAPED_UNICODE)
        ];

        $params = $this->prepareParams($params);
        $params['sign'] = $this->sign($this->buildParams($params));
        $response = json_decode($this->curl($params), true);
        return $response;
    }

    /**
     * 退款查询，必填参数:out_request_no
     * @param $payContent
     * @return mixed
     */
    public function refundQuery($payContent)
    {
        $params = [
            'app_id' => $this->appId,
            'method' => 'alipay.trade.fastpay.refund.query',
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->signType,
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => $this->version,
            'biz_content' => json_encode($payContent, JSON_UNESCAPED_UNICODE)
        ];

        $params = $this->prepareParams($params);
        $params['sign'] = $this->sign($this->buildParams($params));
        $response = json_decode($this->curl($params), true);
        return $response['alipay_trade_fastpay_refund_query_response'];
    }

    private function prepareParams($params)
    {
        $newparams = [];
        foreach ($params as $key => $value) {
            if ($key && $value) {
                $newparams[$key] = $value;
            }
        }
        return $newparams;
    }

    private function buildParams($params)
    {
        ksort($params);
        $newparams = [];
        foreach ($params as $key => $value) {
            $newparams[] = "$key=$value";
        }
        return implode('&', $newparams);
    }

    private function rsaEncode($data)
    {
        $sign = '';
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($this->rsaPublicKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        openssl_public_encrypt($data, $sign, $publicKey);
        return $sign;
    }

    private function sign($data)
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
    private function curl($data = [], $ssl = false, $timeout = 500)
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
}
