<?php

namespace App\Http\Controllers\Home;

use App\Events\OrderEvent;
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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index(Request $request)
    {

        $merId = "000092004078494";
        $orderNo = "202011224444442223";
        $propFile = __DIR__.'/security.ini';

        try {
            $builder = new SignContentBuilder();
            $builder->setSecurityPropFile($propFile);
            $builder->setMerId($merId);
            $builder->setMerOrderNo($orderNo);
            $builder->setMerBgUrl(urlencode(url('test')));
            $builder->setTranDate(date('Ymd'));
            $builder->setTranTime('214521');
            $builder->setTranType('9001');
            $builder->setCardTranData([
                'CertType'=>'01',
                'CertNo'=>'123',
                'CVV2'=>'756',
                'CardNo'=>'1234567890123456'
            ]);

            $content = $builder->getBizContent();
            //return $content;

//            $secssUtil = new SecssUtil();
//            $secssUtil->init($propFile);
//            if ($secssUtil->verify($content)){
//                return 'true';
//            }else{
//                return $secssUtil->getErrMsg();
//            }

            $res = Factory::signing()->testBgSigning()->sendRequest($content);
            parse_str($res, $arr);
            return $arr;
        } catch (ChinaPayException $exception){
            return urldecode($exception->getMessage());
        }

        $builder = new SignQueryContentBuilder();
        $builder->setSecurityPropFile($propFile);
        $builder->setMerId($merId);
        $builder->setTranType('9001');
        $builder->setCardTranData([
            'CertType'=>'01',
            'CertNo'=>'123',
            'CVV2'=>'756',
            'CardNo'=>'1234567890123456'
        ]);
        //return $builder->getBizContent();
        $res = Factory::signQuery()->test()->sendRequest($builder->getBizContent());
        return urldecode($res);

//        ItemCatlog::updateCache();
//        return ItemCatlog::fetchWithCache();


//        $collect = collect(['a'=>1,'b'=>3]);
//
//        return $collect->keys();
        //return app(ItemRepositoryInterface::class)->orderByDesc('itemid')->get();
    }
}
