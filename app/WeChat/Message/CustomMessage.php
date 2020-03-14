<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/30
 * Time: 2:19 PM
 */

namespace App\WeChat\Message;


class CustomMessage
{
    protected $touser;
    protected $msgtype;
    protected $params = [];
    protected $customservice = ['kf_account'=>''];

    /**
     * @param $value
     */
    public function setTouser($value){
        $this->touser = $value;
    }

    /**
     * @return mixed
     */
    public function getTouser(){
        return $this->touser;
    }

    /**
     * @param $value
     */
    public function setMsgtype($value){
        $this->msgtype = $value;
    }

    /**
     * @return mixed
     */
    public function getMsgtype(){
        return $this->msgtype;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setParam($key, $value){
        $this->params[$key] = $value;
    }

    /**
     * @param null $key
     * @return array|mixed
     */
    public function getParams($key = null){
        if (is_null($key)) {
            return $this->params;
        }else {
            return $this->params[$key];
        }
    }

    /**
     * @param $value
     */
    public function setKfAccount($value){
        $this->customservice['kf_account'] = $value;
    }

    /**
     * @return mixed
     */
    public function getKfAccount(){
        return $this->customservice['kf_account'];
    }

    /**
     * @return string
     */
    public function getMsgContent(){
        $content = ['touser'=>$this->touser, 'msgtype'=>$this->msgtype];
        $content[$this->msgtype] = $this->params;
        if ($this->customservice['kf_account']) $content['customservice'] = $this->customservice;
        return json_encode($content, JSON_UNESCAPED_UNICODE);
    }
}
