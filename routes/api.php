<?php/*|--------------------------------------------------------------------------| API Routes|--------------------------------------------------------------------------|| Here is where you can register API routes for your application. These| routes are loaded by the RouteServiceProvider within a group which| is assigned the "api" middleware group. Enjoy building your API!|*/Route::group(['namespace' => 'Api'], function () {    //auth    Route::post('login', 'LoginController@login');    Route::post('register', 'RegisterController@register');    Route::post('wechatapp/login', 'WechatAppController@login');    //home    Route::get('test', 'IndexController@test');    Route::get('food', 'IndexController@food');    Route::get('getfoods', 'IndexController@getFoods');    Route::get('youxuan', 'IndexController@youxuan');    Route::get('fupin', 'IndexController@fupin');    Route::get('tuijian', 'IndexController@tuijian');    Route::get('nutritious', 'IndexController@nutritious');    //apns    Route::post('jpush', 'JpushController@index');    Route::post('apns/jpush', 'ApnsController@jpush');    //模块    Route::get('block/get', 'BlockController@getBlock');    Route::get('block/batchget', 'BlockController@batchgetBlock');    Route::get('block/item/get', 'BlockController@getItem');    Route::get('block/item/batchget', 'BlockController@batchgetItem');    Route::get('block/batchget_item', 'BlockController@batchgetItem');    Route::get('block/getitems', 'BlockController@batchgetItem');    Route::get('itempush/batchget_item', 'ItemPushController@batchgetItem');    //district    Route::get('district/get', 'DistrictController@get');    Route::get('district/batchget', 'DistrictController@batchget');    //item    Route::get('item/get', 'ItemController@get');    Route::get('item/batchget', 'ItemController@batchget');    //catlog    Route::get('item/get_catlog', 'ItemCatlogController@get');    Route::get('item/get_catlog_list', 'ItemCatlogController@batchget');    Route::get('item/get_catlog_tree', 'ItemCatlogController@tree');    Route::get('item/catlog/get', 'ItemCatlogController@get');    Route::get('item/catlog/batchget', 'ItemCatlogController@batchget');    Route::get('item/catlog/tree', 'ItemCatlogController@tree');    //shop    Route::get('shop/get', 'ShopController@get');    Route::get('shop/batchget', 'ShopController@batchget');    Route::get('shop/getshoplist', 'ShopController@batchget');    Route::get('shop/batchget_item', 'ShopController@batchgetItem');    //post    Route::get('post/get_catlog', 'PostCatlogController@get');    Route::get('post/get_catlog_list', 'PostCatlogController@batchget');    Route::get('post/get', 'PostController@get');    Route::get('post/batchget', 'PostController@batchget');    Route::get('post/catlog/get', 'PostCatlogController@get');    Route::get('post/catlog/batchget', 'PostCatlogController@batchget');    //productnews    Route::get('productnews/batchget', 'ProductNewsController@batchget');    //buynews    Route::get('buynews/get', 'BuyNewsController@get');    Route::get('buynews/batchget', 'BuyNewsController@batchget');    //wechat login    Route::post('wechat/login', 'WechatController@login');    //mini_program    Route::post('miniprogram/login', 'MiniprogramController@login');    //alipay    Route::any('alipay/sign', 'AlipayController@sign');    Route::any('alipay/query', 'AlipayController@query');    Route::group(['middleware' => 'auth:api'], function () {        //address        Route::get('address/get', 'AddressController@get');        Route::get('address/batchget', 'AddressController@batchget');        Route::post('address/setdefault', 'AddressController@setDefault');        Route::post('address/store', 'AddressController@save');        Route::post('address/save', 'AddressController@save');        Route::post('address/delete', 'AddressController@delete');        //feedback        Route::post('feedback/save', 'FeedBackController@save');        //collect        Route::get('collect/batchget', 'CollectController@batchget');        //security        Route::post('security/update_password', 'SecurityController@updatePassword');        //auction        Route::post('auction/createorder', 'AuctionController@createOrder');        Route::post('auction/settlement', 'AuctionController@settlement');        //order        Route::get('order/get', 'BoughtController@get');        Route::get('order/batchget', 'BoughtController@batchget');        Route::post('order/close', 'BoughtController@close');        Route::post('order/delete', 'BoughtController@delete');        Route::post('order/confirm', 'BoughtController@confirm');        //bought        Route::get('bought/get', 'BoughtController@get');        Route::get('bought/batchget', 'BoughtController@batchget');        Route::post('bought/close', 'BoughtController@close');        Route::post('bought/delete', 'BoughtController@delete');        Route::post('bought/confirm', 'BoughtController@confirm');        Route::post('bought/notice', 'BoughtController@notice');        Route::get('bought/get_shipping', 'BoughtController@getShipping');        //sold        Route::get('sold/get', 'SoldController@get');        Route::get('sold/batchget', 'SoldController@batchget');        Route::post('sold/send', 'SoldController@send');        //wechat        Route::post('wechat/get_pay_config', 'WechatPayController@getMicroPayConfig');        Route::post('wechat/get_micropay_config', 'WechatPayController@getMicroPayConfig');        //cart        Route::post('cart/add', 'CartController@add');        Route::post('cart/delete', 'CartController@delete');        Route::post('cart/update_quantity', 'CartController@updateQuantity');        Route::any('cart/get_items', 'CartController@getItems');        //user        Route::any('user/info', 'UserController@info');        Route::any('user/update', 'UserController@update');        Route::any('user/avatar', 'UserController@avatar');        //express        Route::get('express/get', 'ExpressController@get');        Route::get('express/batchget', 'ExpressController@batchget');        Route::any('express/get_express', 'ExpressController@getExpress');        //material        Route::post('material/upload_img', 'MaterialController@uploadImg');        //mini_program        Route::post('miniprogram/get_pay_config', 'MiniprogramController@getPayConfig');        Route::post('miniprogram/payment/config', 'MiniprogramController@getPayConfig');        //wallet        Route::get('wallet/get', 'WelletController@get');        //transaction        Route::get('transaction/get', 'TransactionController@get');        Route::get('transaction/batchget', 'TransactionController@batchget');        //item manager        Route::get('manager/item/get', 'ItemManagerController@get');        Route::get('manager/item/batchget', 'ItemManagerController@batchget');        Route::post('manager/item/togglesale', 'ItemManagerController@toggleSale');        Route::post('manager/item/delete', 'ItemManagerController@delete');        Route::post('manager/item/save', 'ItemManagerController@store');        //shop manager        Route::get('manager/shop/get', 'ShopManagerController@get');        Route::post('manager/shop/save', 'ShopManagerController@store');        //wechatapp        Route::post('buynews/store','BuyNewsController@store');        Route::post('buynews/delete','BuyNewsController@delete');        Route::post('productnews/store','ProductNewsController@store');    });    //version    Route::any('version', function () {        $userAgent = 'time:' . time() . ',' . $_SERVER['HTTP_USER_AGENT'];        if (strpos($userAgent, 'Android') || strpos($userAgent, 'okhttp')) {            return ajaxReturn(['version' => 4.2, 'userAgent' => $userAgent]);        } else {            return ajaxReturn(['version' => 4.2, 'userAgent' => $userAgent]);        }    });    Route::any('version/sellerapp', function () {        $userAgent = 'time:' . time() . ',' . $_SERVER['HTTP_USER_AGENT'];        if (strpos($userAgent, 'Android') || strpos($userAgent, 'okhttp')) {            return ajaxReturn(['version' => 3.0, 'userAgent' => $userAgent]);        } else {            return ajaxReturn(['version' => 3.0, 'userAgent' => $userAgent]);        }    });});