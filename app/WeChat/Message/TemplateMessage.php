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
 * Time: 2:17 PM
 */

namespace App\WeChat\Message;


class TemplateMessage
{
    protected $touser;//接收者openid
    protected $template_id;//模板ID
    protected $url;//模板跳转链接
    protected $color = '#333';//模板内容字体颜色，不填默认为黑色
    protected $data = [];//模板数据
    //小程序参数
    protected $miniprogram = [
        'appid'=>'',//所需跳转到的小程序appid（该小程序appid必须与发模板消息的公众号是绑定关联关系）
        'pagepath'=>''//所需跳转到小程序的具体页面路径，支持带参数,（示例index?foo=bar）
    ];

    /**
     * @return mixed
     */
    public function getTouser()
    {
        return $this->touser;
    }

    /**
     * @param mixed $touser
     */
    public function setTouser($touser): void
    {
        $this->touser = $touser;
    }

    /**
     * @return mixed
     */
    public function getTemplateId()
    {
        return $this->template_id;
    }

    /**
     * @param mixed $template_id
     */
    public function setTemplateId($template_id): void
    {
        $this->template_id = $template_id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setFirst($value, $color='#000'){
        $this->setDataValue('first', $value, $color);
    }

    public function setRemark($value, $color = '#000'){
        $this->setDataValue('remark', $value, $color);
    }

    /**
     * @param $key
     * @param $value
     * @param string $color
     */
    public function setDataValue($key, $value, $color = "#000"){
        $this->data[$key] = [
            'value'=>$value,
            'color'=>$color
        ];
    }

    /**
     * 设置小程序参数
     * @param $appid
     * @param $pagepath
     */
    public function setMiniprogram($appid, $pagepath){
        $this->miniprogram = [
            'appid'=>$appid,
            'pagepath'=>$pagepath
        ];
    }

    public function getMiniprogram(){
        return $this->miniprogram;
    }

    /**
     * @return array
     */
    public function getMsgContent(){
        $content = [];

        if ($this->touser) {
            $content['touser'] = $this->touser;
        }

        if ($this->template_id) {
            $content['template_id'] = $this->template_id;
        }

        if ($this->data) {
            $content['data'] = $this->data;
        }

        if ($this->url) {
            $content['url'] = $this->url;
        }

        if ($this->color) {
            $content['color'] = $this->color;
        }

        if ($this->miniprogram) {
            if ($this->miniprogram['appid'] && $this->miniprogram['pagepath']) {
                $content['miniprogram'] = $this->miniprogram;
            }
        }

        return $content;
    }
}
