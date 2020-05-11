<?php

namespace App\Http\Controllers\Home;

use App\Jobs\OrderProcessNotice;
use App\Jobs\SendEmail;
use App\Jobs\TestJob;
use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\Message;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\User;
use App\Notifications\SystemMessageNotification;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\WeChat\WechatDefaultConfig;
use ChinaPay\Exception\ChinaPayException;
use ChinaPay\Factory;
use ChinaPay\Payment\PayContentBuilder;
use ChinaPay\SecssUtil;
use ChinaPay\Signing\Application;
use ChinaPay\Signing\SignContentBuilder;
use ChinaPay\SignQuery\SignQueryContentBuilder;
use ChinaPay\SignSms\SignSmsContentBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    use WechatDefaultConfig;

    public function index(Request $request)
    {

        //return $this->officialAccount()->customer_service->online();
        //return $this->officialAccount()->customer_service_session->create('kf2001@guizhoudashixiong','orT_zvy-cnPpKsKr_HDLaLWvAL6w');

        //return 'ok';

        return $this->sing();

        $merId = "531112004160001";
        $orderNo = "20201122593490438098";
        $propFile = __DIR__ . '/security2.ini';
        $tranTime = '131757';//date('His');
        $cardTranData = [
            'CertType' => '01',
            'CertNo' => '522731199706113806',
            'AccType' => '01',
            'AccName' => '韦天琴',
            'CardNo' => '6228480878140397075',
            'MobileNo'=>'18847151058'
        ];
        $merBgUrl = url('notify');

        //发短信
//        try {
//            $builder = new SignSmsContentBuilder();
//            $builder->setSecurityPropFile($propFile);
//            $builder->setMerId($merId);
//            $builder->setMerOrderNo($orderNo);
//            $builder->setTranDate(date('Ymd'));
//            $builder->setTranTime($tranTime);
//            $builder->setCardTranData($cardTranData);
//            $content = $builder->getBizContent();
//            dump($content);
//
////        $secssUtil = new SecssUtil();
////        $secssUtil->init($propFile);
////        if ($secssUtil->verify($content)) {
////            return 'true';
////        } else {
////            return $secssUtil->getErrMsg();
////        }
//
//            $res = Factory::signSms()->sendRequest($builder->getBizContent());
//            parse_str($res, $arr);
//            dump($arr);
//        } catch (ChinaPayException $exception) {
//            dump($exception->getMessage());
//        }
//
//        return '';
        //签约
        try {
            $builder = new SignContentBuilder();
            $builder->setSecurityPropFile($propFile);
            $builder->setMerId($merId);
            $builder->setMerOrderNo($orderNo);
            $builder->setMerBgUrl($merBgUrl);
            $builder->setTranDate(date('Ymd'));
            $builder->setTranTime($tranTime);
            $builder->setTranType('9004');
            $builder->setCardTranData([
                'CertType' => '01',
                'CertNo' => '522731199706113806',
                'AccType' => '01',
                'AccName' => '韦天琴',
                'CardNo' => '6228480878140397075',
                'MobileNo'=>'18847151058',
                'MobileAuthCode'=>'882973'
            ]);
            $builder->set('AcqCode','000000000000014');

            $content = $builder->getBizContent();
            dump($content);

//            $secssUtil = new SecssUtil();
//            $secssUtil->init($propFile);
//            if ($secssUtil->verify($content)){
//                return 'true';
//            }else{
//                return $secssUtil->getErrMsg();
//            }

            $res = Factory::signing()->bgSigning()->sendRequest($content);
            parse_str($res, $arr);
            dump($arr);
            return '';
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
    }

    /**
     * @return string
     * @throws ChinaPayException
     */
    protected function pay(){
        $merId = "531112004160001";
        $orderNo = "2020112259349043809822";
        $propFile = __DIR__ . '/security2.ini';
        $tranTime = '233200';//date('His');
        $cardTranData = [
            'CertType' => '01',
            'CertNo' => '522731199706113806',
            'AccType' => '01',
            'AccName' => '韦天琴',
            'CardNo' => '6228480878140397075',
            'MobileNo'=>'18847151058'
        ];
        $merBgUrl = url('notify');

        $builder = new PayContentBuilder();
        $builder->setSecurityPropFile($propFile);
        $builder->setOrderAmt(1);
        $builder->setTranTime($tranTime);
        $builder->setTranDate(date('Ymd'));
        $builder->setMerOrderNo($orderNo);
        $builder->setMerId($merId);
        $builder->setMerBgUrl($merBgUrl);
        $builder->setTranType('0004');
        $builder->setMerPageUrl($merBgUrl);
        $builder->setRemoteAddr(\request()->ip());
//        $builder->setAccessType(0);
//        $builder->set('CurryNo','CNY');
//        $builder->set('SplitType','0001');
//        $builder->set('SplitMethod',0);
//        $builder->set('CommodityMsg','iPhone手机一部');
        $builder->setCardTranData($cardTranData);

        //dd($builder->getBizContent());

        return Factory::payment()->bgPay()->sendRequest($builder->getBizContent());
    }

    private function sing(){
        $merId = "531112004160001";
        $orderNo = "20201122593490438098";
        $propFile = __DIR__ . '/security2.ini';
        $tranTime = '131757';//date('His');
        $cardTranData = [
            'CertType' => '01',
            'CertNo' => '522731199706113806',
            'AccType' => '01',
            'AccName' => '韦天琴',
            'CardNo' => '6228480878140397075',
            'MobileNo'=>'18847151058'
        ];
        $merBgUrl = url('notify');

        try {
            $builder = new SignContentBuilder();
            $builder->setSecurityPropFile($propFile);
            $builder->setMerId($merId);
            $builder->setMerOrderNo($orderNo);
            $builder->setMerBgUrl($merBgUrl);
            $builder->setTranDate(date('Ymd'));
            $builder->setTranTime($tranTime);
            $builder->setTranType('9904');
            $builder->setCardTranData([
                'CertType' => '01',
                'CertNo' => '522731199706113806',
                'AccType' => '01',
                'AccName' => '韦天琴',
                'CardNo' => '6228480878140397075',
                'MobileNo'=>'18847151058',
                'MobileAuthCode'=>'882973'
            ]);
            $builder->set('AcqCode','000000000000014');

            $content = $builder->getBizContent();
            dump($content);

//            $secssUtil = new SecssUtil();
//            $secssUtil->init($propFile);
//            if ($secssUtil->verify($content)){
//                return 'true';
//            }else{
//                return $secssUtil->getErrMsg();
//            }

            $res = Factory::signing()->bgSigning()->sendRequest($content);
            parse_str($res, $arr);
            dump($arr);
            return '';
        } catch (ChinaPayException $exception) {
            return urldecode($exception->getMessage());
        }
    }
}
