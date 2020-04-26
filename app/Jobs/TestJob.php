<?php

namespace App\Jobs;

use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\TemplateMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
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
     */
    public function handle()
    {
        $message = new TemplateMessage();
        $message->setFirst('亲，宝贝已经启程了，好想快点来到你身边');
        $message->setDataValue('delivername','顺丰快递');
        $message->setDataValue('ordername','3291987391');
        $message->setRemark('如果疑问，请在微信服务号中输入“KF”，**将在第一时间为您服务！');
        $message->setTouser('orT_zvy-cnPpKsKr_HDLaLWvAL6w');
        $message->setTemplateId('hYZbMv0kWZYlkPCoHz_TNL495mj0hU3Dzewr_QItqjg');

        $this->officialAccount()->template_message->send($message->getMsgContent());
    }
}
