<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use App\WeChat\Message\TemplateMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStateNotification extends Notification
{
    use Queueable;

    protected $order;

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

    public function toOfficialAccount(User $notifiable)
    {
        $this->order->load(['buyer', 'items']);

        //dd($this->order->toArray());
        if ($connect = $notifiable->connects()->where('appid', 'wx68fe44528075f3cb')->first()) {
            $message = new TemplateMessage();
            $message->setTemplateId('z3fPEVyzTwrkTjRO6OXGFtleP4djBADaOeNDRxskTqM');
            $message->setFirst(trans('notification.buyer_order_notification_titles.' . $this->order->order_state) ?? '');
            $message->setRemark(trans('notification.buyer_order_notification_remark') ?? '');
            $message->setDataValue('keyword1', $this->order->order_no ?? '');
            $message->setDataValue('keyword2', $this->order->items()->first()->title ?? '');
            $message->setDataValue('keyword3', formatAmount($this->order->total_fee) ?? '');
            $message->setDataValue('keyword4', $this->order->bought_order_state_des ?? '');
            $message->setDataValue('keyword5', $this->order->created_at->format('Y-m-d H:i:s'));
            $message->setTouser($connect->openid);
            return $message->getMsgContent();
        }
        return null;
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
}
