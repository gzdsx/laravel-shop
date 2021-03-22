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
    //接收者openid
    protected $touser;
    //模板ID
    protected $template_id;
    //模板跳转链接
    protected $url;
    //模板数据
    protected $data;
    //场景值
    protected $scene;
    //小程序参数
    //    [
    //        'appid' => '',//所需跳转到的小程序appid（该小程序appid必须与发模板消息的公众号是绑定关联关系）
    //        'pagepath' => ''//所需跳转到小程序的具体页面路径，支持带参数,（示例index?foo=bar）
    //    ]
    protected $miniprogram;

    protected $content = [];


    /**
     * @param mixed $touser
     */
    public function setTouser($touser)
    {
        $this->touser = $touser;
    }

    /**
     * @param mixed $template_id
     */
    public function setTemplateId($template_id)
    {
        $this->template_id = $template_id;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $miniprogram
     */
    public function setMiniprogram($miniprogram)
    {
        $this->miniprogram = $miniprogram;
    }

    /**
     * @param mixed $scene
     */
    public function setScene($scene)
    {
        $this->scene = $scene;
    }

    /**
     * @return array
     */
    public function content()
    {

        if ($this->touser) {
            $this->content['touser'] = $this->touser;
        }

        if ($this->template_id) {
            $this->content['template_id'] = $this->template_id;
        }

        if ($this->url) {
            $this->content['url'] = $this->url;
        }

        if ($this->miniprogram) {
            $this->content['miniprogram'] = $this->miniprogram;
        }

        if ($this->scene) {
            $this->content['scene'] = $this->scene;
        }

        if ($this->data) {
            $this->content['data'] = $this->data;
        }

        return $this->content;
    }
}
