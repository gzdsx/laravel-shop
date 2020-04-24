<?php

namespace App\Http\Controllers\Home;

use App\Events\OrderEvent;
use App\Jobs\OrderProcessNotice;
use App\Jobs\SendEmail;
use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\Message;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\User;
use App\Notifications\SystemMessageNotification;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use ChinaPay\Exception\ChinaPayException;
use ChinaPay\Factory;
use ChinaPay\Payment\PayContentBuilder;
use ChinaPay\SecssUtil;
use ChinaPay\Signing\Application;
use ChinaPay\Signing\SignContentBuilder;
use ChinaPay\SignQuery\SignQueryContentBuilder;
use ChinaPay\Sms\SmsContentBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::orderByDesc('order_id')->first();
        for ($i=0;$i<30;$i++){
            dispatch(new OrderProcessNotice($order, 'created'))->delay(now()->addMinutes(10));
        }

        return 'ok';

        $merId = "531112004160001";
        $orderNo = "20201122593490438098";
        $propFile = __DIR__ . '/security.ini';
        $tranTime = '191557';//date('His');
        $cardTranData = [
//            'CertType' => '01',
//            'CertNo' => '520221199608090813',
//            'AccType' => '01',
            'AccName' => '张超',
            'CardNo' => '6212262402018407292',
//            'MobileNo'=>'18786709420'
        ];
        $merBgUrl = url('notify');

        //发短信
        try {
            $builder = new SmsContentBuilder();
            $builder->setSecurityPropFile($propFile);
            $builder->setMerId($merId);
            $builder->setMerOrderNo($orderNo);
            $builder->setTranDate(date('Ymd'));
            $builder->setTranTime($tranTime);
            $builder->setCardTranData($cardTranData);

            $content = $builder->getBizContent();
            dump($content);

//        $secssUtil = new SecssUtil();
//        $secssUtil->init($propFile);
//        if ($secssUtil->verify($content)) {
//            return 'true';
//        } else {
//            return $secssUtil->getErrMsg();
//        }

            $res = Factory::sms()->sendRequest($builder->getBizContent());
            parse_str($res, $arr);
            dump($arr);
        } catch (ChinaPayException $exception) {
            dump($exception->getMessage());
        }

        //签约
        try {
            $builder = new SignContentBuilder();
            $builder->setSecurityPropFile($propFile);
            $builder->setMerId($merId);
            $builder->setMerOrderNo($orderNo);
            $builder->setMerBgUrl($merBgUrl);
            $builder->setTranDate(date('Ymd'));
            $builder->setTranTime('214521');
            $builder->setTranType('9004');
            $builder->setCardTranData([
                'CertType' => '01',
                'CertNo' => '522727198502011219',
                'AccType' => '01',
                'AccName' => '宋德伟',
                'CardNo' => '4563510100860693112'
            ]);

            $content = $builder->getBizContent();
            dump($content);

//            $secssUtil = new SecssUtil();
//            $secssUtil->init($propFile);
//            if ($secssUtil->verify($content)){
//                return 'true';
//            }else{
//                return $secssUtil->getErrMsg();
//            }

            $res = Factory::signing()->testBgSigning()->sendRequest($content);
            parse_str($res, $arr);
            dump($arr);
        } catch (ChinaPayException $exception) {
            return urldecode($exception->getMessage());
        }

        //签约查询
        try {
            $builder = new SignQueryContentBuilder();
            $builder->setSecurityPropFile($propFile);
            $builder->setMerId($merId);
            $builder->setTranType('9001');
            $builder->setCardTranData([
                'CertType' => '01',
                'CertNo' => '123',
                'CVV2' => '756',
                'CardNo' => '1234567890123456'
            ]);

            $content = $builder->getBizContent();
            dump($content);

            $res = Factory::signQuery()->sendRequest($content);
            parse_str($res, $arr);
            dump($arr);
        } catch (ChinaPayException $exception) {
            dump($exception->getMessage());
        }

//        ItemCatlog::updateCache();
//        return ItemCatlog::fetchWithCache();


//        $collect = collect(['a'=>1,'b'=>3]);
//
//        return $collect->keys();
        //return app(ItemRepositoryInterface::class)->orderByDesc('itemid')->get();
    }
}
