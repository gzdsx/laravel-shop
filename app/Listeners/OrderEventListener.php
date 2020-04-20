<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\WeChat\Message\TemplateMessage;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderEventListener
{
    use WechatDefaultConfig;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param OrderEvent $event
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(OrderEvent $event)
    {
        $order = $event->order;
        //创建订单
        if ($event->type == 'created')
        {

        }

        //支付订单
        if ($event->type == 'paid')
        {

        }

        if ($event->type == 'send')
        {

        }

        //确认收货到货物，交易成功
        if ($event->type == 'confirmed')
        {

        }

        if ($event->type == 'refunding')
        {

        }

        if ($event->type == 'refunded')
        {

        }
    }
}
