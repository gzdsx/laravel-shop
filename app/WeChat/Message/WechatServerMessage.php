<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-15
 * Time: 01:29
 */

namespace App\WeChat\Message;


use Illuminate\Support\Collection;

class WechatServerMessage extends Collection
{
    /**
     * @return mixed
     */
    public function toUserName()
    {
        return $this->get('ToUserName');
    }

    /**
     * @return mixed
     */
    public function fromUserName()
    {
        return $this->get('FromUserName');
    }

    /**
     * @return mixed
     */
    public function msgType()
    {
        return $this->get('MsgType');
    }

    /**
     * @return mixed
     */
    public function event()
    {
        return $this->get('Event');
    }

    /**
     * @return mixed
     */
    public function eventKey()
    {
        return $this->get('EventKey');
    }

    /**
     * @return mixed
     */
    public function ticket()
    {
        return $this->get('Ticket');
    }

    /**
     * @return mixed
     */
    public function createTime()
    {
        return $this->get('CreateTime');
    }
}
