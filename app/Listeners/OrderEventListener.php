<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Notifications\OrderStateNotification;
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
        $order->buyer->notify(new OrderStateNotification($order));

        //创建订单
        if ($event->type == 'created')
        {
            $item = $order->items()->first();

            $message = new TemplateMessage();
            $message->setTemplateId('_ezyNqtHKGHjpeqIA-IuMJuR8QI6L_3JE_dHQzxz9tQ');
            $message->setFirst('尊敬的商家，您有一笔新订单！');
            $message->setRemark('点击查看订单详情！');
            $message->setUrl(url('h5/trade/sold/order?order_id='.$order->order_id));
            $message->setDataValue('keyword1', $order->total_fee.'元');
            $message->setDataValue('keyword2', $item->title);
            $message->setDataValue('keyword3', $order->order_no);
            $message->setDataValue('keyword4', $order->buyer->username);
            $message->setTouser(setting('wechat_kefu_openid'));
            try{
                $this->officialAccount()->template_message->send($message->getMsgContent());
            }catch (\Exception $exception){

            }
        }

        //支付订单
        if ($event->type == 'paid')
        {
            $item = $order->items()->first();
            $message = new TemplateMessage();
            $message->setTemplateId('QGCqaDZqAatTb-y2rY5spw2uYJlCsLL_DJu9e7ylvEw');
            $message->setFirst('尊敬的商家，您有一笔订单客户已完成付款！');
            $message->setRemark('点击查看订单详情！');
            $message->setUrl(url('h5/trade/sold/order?order_id='.$order->order_id));
            $message->setDataValue('keyword1', $order->order_no);
            $message->setDataValue('keyword2', $item->title);
            $message->setDataValue('keyword3', $order->total_fee.'元');
            $message->setDataValue('keyword4', $order->order_state_des);
            $message->setDataValue('keyword5', $order->created_at);
            $message->setTouser(setting('wechat_kefu_openid'));
            try{
                $this->officialAccount()->template_message->send($message->getMsgContent());
            }catch (\Exception $exception){

            }
        }

        if ($event->type == 'send')
        {

        }

        //确认收货到货物，交易成功
        if ($event->type == 'confirmed')
        {
            //$buyer = $order->buyer;
            $invite = Invite::where('invitee_uid', $order->buyer_uid)->first();
            if ($invite){
                $inviter = $invite->user;
                if ($inviter){
                    $connect = $inviter->connects()->first();
                    if ($connect){
                        $total_amount = $order->items()->sum('redpack_amount');
                        if ($total_amount >= 1){
                            $redpackData = [
                                'mch_billno'   => createTransactionNo(),
                                'send_name'    => '红包来啦!',
                                're_openid'    => $connect->openid,
                                'total_num'    => 1,  //固定为1，可不传
                                'total_amount' => $total_amount*100,  //单位为分，不小于100
                                'wishing'      => '感谢您参加粗耕购物节活动',
                                'client_ip'    => request()->getClientIp(),  //可不传，不传则由 SDK 取当前客户端 IP
                                'act_name'     => '一起拼团赢红包',
                                'remark'       => '邀请好友来粗耕购物获得红包',
                                // ...
                            ];
                            $this->payment($connect->appid)->redpack->sendNormal($redpackData);
                        }
                    }
                }
            }
        }

        if ($event->type == 'refunding')
        {

        }

        if ($event->type == 'refunded')
        {
            //退货恢复库存
            $order->items()->with('item')->get()->map(function ($item) use (&$shop){
                if ($item->item)
                {
                    $item->item->stock += $item->quantity;
                    $item->item->save();
                }
            });
        }
    }
}
