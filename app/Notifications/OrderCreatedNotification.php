<?php

namespace App\Notifications;

use App\Models\Order;
use App\WeChat\Message\TemplateMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OfficialAccountChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toOfficialAccount($notifiable)
    {
        $order = $this->order;
        $item = $order->items()->first();
        $message = new TemplateMessage();
        $message->setTemplateId('_ezyNqtHKGHjpeqIA-IuMJuR8QI6L_3JE_dHQzxz9tQ');
        $message->setFirst('尊敬的商家，您有一笔新订单！');
        $message->setRemark('点击查看订单详情！');
        $message->setUrl(url('h5/trade/sold/order?order_id=' . $order->order_id));
        $message->setDataValue('keyword1', $order->total_fee . '元');
        $message->setDataValue('keyword2', $item->title);
        $message->setDataValue('keyword3', $order->order_no);
        $message->setDataValue('keyword4', $order->buyer->username);
        $message->setTouser(setting('wechat_kefu_openid'));

        return [$message];
    }
}
