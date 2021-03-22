<?php

namespace App\Jobs;

use App\Models\User;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\TemplateMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use WechatDefaultConfig;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function handle()
    {
        $user = User::find('1042159');
        $message = new TemplateMessage();
        $message->setTemplateId('R-29nZ4wQT-6dRsBa5to711IYxBYsKwxTXzA4JnbUfc');
        $message->setFirst('你有订单买家已完成付款，请及时发货');
        $message->setRemark('查看订单详情');
        $message->setDataValue('orderProductPrice', 100);
        $message->setDataValue('orderProductName', 'job test');
        $message->setDataValue('orderAddress', '贵州平塘');
        $message->setDataValue('orderName', '123344555');

        $message->setTouser($user->connects()->whereAppid($this->officialAccount()->config->get('app_id'))->first()->openid);
        return $this->officialAccount()->template_message->send($message->getMsgContent());
    }
}
