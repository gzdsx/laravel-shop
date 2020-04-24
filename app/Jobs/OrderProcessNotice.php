<?php

namespace App\Jobs;

use App\Models\Order;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\TemplateMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderProcessNotice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use WechatDefaultConfig;

    protected $order;
    protected $event;


    /**
     * OrderNotification constructor.
     * @param Order|\Illuminate\Database\Eloquent\Model $order $order
     * @param $event
     */
    public function __construct(Order $order, $event)
    {
        $this->order = $order;
        $this->event = $event;
    }

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        if ($this->event == 'created'){
            $this->sendCreateNotice();
        }

        if ($this->event == 'paid'){
            $this->sendPaidNotice();
        }
    }

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendCreateNotice(){
        $order = $this->order;
        $item = $order->items->first();
        $message = new TemplateMessage();
        $message->setTemplateId('_ezyNqtHKGHjpeqIA-IuMJuR8QI6L_3JE_dHQzxz9tQ');
        $message->setFirst('尊敬的商家，您有一笔新订单！');
        $message->setRemark('点击查看订单详情！');
        $message->setUrl(url('h5/sold/order/detail/'.$order->order_id.'.html'));
        $message->setDataValue('keyword1', $order->total_fee.'元');
        $message->setDataValue('keyword2', $item->title);
        $message->setDataValue('keyword3', $order->order_no);
        $message->setDataValue('keyword4', $order->buyer->username);
        foreach (config('shop.kefu') as $kefu){
            $message->setTouser($kefu['openid']);
            $res[] = $this->officialAccount()->template_message->send($message->getMsgContent());
        }
    }

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendPaidNotice(){
        $order = $this->order;
        $item = $order->items->first();
        $message = new TemplateMessage();
        $message->setTemplateId('QGCqaDZqAatTb-y2rY5spw2uYJlCsLL_DJu9e7ylvEw');
        $message->setFirst('尊敬的商家，您有一笔订单客户已完成付款！');
        $message->setRemark('点击查看订单详情！');
        $message->setUrl(url('h5/sold/order/detail/'.$order->order_id.'.html'));
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
}
