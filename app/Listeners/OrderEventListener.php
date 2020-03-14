<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Models\Invite;
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
     * Handle the event.
     *
     * @param OrderEvent $event
     * @return void
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function handle(OrderEvent $event)
    {
        $order = $event->order;
        $order->buyer->notify(new OrderStateNotification($order));

        //创建订单
        if ($event->type == 'created')
        {
            $shop = $order->shop;
            $shipping = $order->shipping;

            $message = new TemplateMessage();
            $message->setTemplateId('kCEcsEZTI8IBDBOO8QV_f6wZH6xUhYkVxY2rUGrxuDI');
            $message->setFirst($shop->shop_name.'商家，您有一笔新订单！');
            $message->setRemark('请注意查收！');
            $message->setDataValue('keyword1', $order->order_no);
            $message->setDataValue('keyword2', $order->items()->first()->title);
            $message->setDataValue('keyword3', $order->total_fee);
            $message->setDataValue('keyword4', $order->pay_type_des);
            $message->setDataValue('keyword5', $shipping->consignee.' '.$shipping->phone.' '.$shipping->province.$shipping->city.$shipping->district.$shipping->street);

            $shop->kefus->map(function ($kefu) use ($message){
                $message->setTouser($kefu->openid);
                try{
                    $this->officialAccount()->template_message->send($message->getMsgContent());
                }catch (\Exception $exception){

                }
            });
        }

        //支付订单
        if ($event->type == 'paid')
        {
            //付款减库存
            $shop = $event->order->shop;
            $order->items()->with('item')->get()->map(function ($item) use (&$shop){
                if ($item->item)
                {
                    $item->item->sold+= $item->quantity;
                    if ($item->item->stock >= $item->quantity)
                    {
                        $item->item->stock -= $item->quantity;
                    } else {
                        $item->item->stock = 0;
                    }
                    $item->item->save();
                }
                $shop->total_sold+= $item->quantity;
            });
            $shop->save();
        }

        if ($event->type == 'send')
        {
            $connect = $order->buyer->connects()->miniProgram()->first();
            if ($connect)
            {

            }
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
