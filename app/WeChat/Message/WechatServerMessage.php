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
    public function getToUserName()
    {
        return $this->get('ToUserName');
    }

    public function getFromUserName()
    {
        return $this->get('FromUserName');
    }

    public function getMsgType()
    {
        return $this->get('MsgType');
    }

    public function getEvent()
    {
        return $this->get('Event');
    }

    public function getEventKey()
    {
        return $this->get('EventKey');
    }

    public function getTicket()
    {
        return $this->get('Ticket');
    }

    public function getCreateTime()
    {
        return $this->get('CreateTime');
    }
}
