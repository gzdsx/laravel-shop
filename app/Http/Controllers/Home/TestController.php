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
use ChinaPay\Signing\Application;
use ChinaPay\Signing\SignContentBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index(Request $request)
    {
//        return DB::connection('cugeng')->table('item')
//            ->where('on_sale',1)->orderByDesc('itemid')->take(100)->get();

//        $builder = new SignContentBuilder();
//        $builder->setMerOrderNo(time());
//        $builder->setMerBgUrl(url('test'));
//        $builder->setCardTranData('{"CertType":"01","CertNo":"123","CVV2":"756","CardNo":"1234567890123456"}');
//
//        try {
//            $res = Factory::signing([
//                'mer_id'=>'000092004078494',
//                'security_ini'=>__DIR__.'/security.ini'
//            ])->test()->requestSign($builder->getBizContent());
//            return $res;
//        } catch (ChinaPayException $exception){
//            return $exception->getMessage();
//        }

//        ItemCatlog::updateCache();
//        return ItemCatlog::fetchWithCache();


//        $collect = collect(['a'=>1,'b'=>3]);
//
//        return $collect->keys();
        return app(ItemRepositoryInterface::class)->orderByDesc('itemid')->get();
    }
}
