<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPaid;
use App\Jobs\SendOrderPaidNotice;
use App\Jobs\UpdateMemberLevel;
use App\Models\User;
use App\Models\UserMember;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderPaidListener implements ShouldQueue
{
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
     * @param OrderPaid $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        dispatch(new SendOrderPaidNotice($event->order));
        if ($buyer = $event->order->buyer) {
            if ($event->order->is_hot) {
                //第一次购买爆单产品获得会员资格
                if (!$member = $buyer->member) {
                    $member = UserMember::orderBy('level')->first();
                    $buyer->member()->associate($member)->save();

                    $this->updateCredits($buyer);
                }
            }

        }
    }

    /**
     * 更新会员积分
     * @param User $user
     */
    public function updateCredits(User $user)
    {
        if ($parent = $user->parent) {
            if ($member = $parent->member) {
                $parent->credits += $member->bonus;
                $parent->save();
                dispatch(new UpdateMemberLevel($user));
                $this->updateCredits($parent);
            }
        }
    }
}
