<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\TemplateMessage;
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
            $item = $order->items->first();
            $message = new TemplateMessage();
            $message->setTemplateId('_ezyNqtHKGHjpeqIA-IuMJuR8QI6L_3JE_dHQzxz9tQ');
            $message->setFirst('尊敬的商家，您有一笔新订单！');
            $message->setRemark('点击查看订单详情！');
            $message->setUrl(url('h5/sold/#/order/detail/'.$order->order_id));
            $message->setDataValue('keyword1', $order->total_fee.'元');
            $message->setDataValue('keyword2', $item->title);
            $message->setDataValue('keyword3', $order->order_no);
            $message->setDataValue('keyword4', $order->buyer->username);
            foreach (config('shop.kefu') as $kefu){
                $message->setTouser($kefu['openid']);
                $res[] = $this->officialAccount()->template_message->send($message->getMsgContent());
            }
        }

        //支付订单
        if ($event->type == 'paid')
        {
            $item = $order->items->first();
            $message = new TemplateMessage();
            $message->setTemplateId('QGCqaDZqAatTb-y2rY5spw2uYJlCsLL_DJu9e7ylvEw');
            $message->setFirst('尊敬的商家，您有一笔订单客户已完成付款！');
            $message->setRemark('点击查看订单详情！');
            $message->setUrl(url('h5/sold/#/order/detail/'.$order->order_id));
            $message->setDataValue('keyword1', $order->order_no);
            $message->setDataValue('keyword2', $item->title);
            $message->setDataValue('keyword3', $order->total_fee.'元');
            $message->setDataValue('keyword4', $order->order_state_des);
            $message->setDataValue('keyword5', $order->created_at);

            foreach (config('shop.kefu') as $kefu){
                $message->setTouser($kefu['openid']);
                $this->officialAccount()->template_message->send($message->getMsgContent());
            }
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
