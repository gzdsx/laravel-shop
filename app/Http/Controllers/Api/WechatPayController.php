<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Wechat\WechatPayService;
use App\Traits\Wechat\WechatPayManagers;
use Illuminate\Http\Request;

class WechatPayController extends BaseController
{
    use WechatPayManagers;

    protected $orderRepository;
    public function __construct(Request $request, OrderRepositoryInterface $orderRepository)
    {
        parent::__construct($request);
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getPayConfig(Request $request)
    {
        $appid = $this->getAppidForRequest();
        $openid = $this->getOpenidForRequest();
        $order = $this->orderRepository->findOrFail($request->input('order_id'));
        $payment = $this->payment($appid);
        $service = new WechatPayService();
        $response = $service->unifiedOrder($order, $payment, $openid);

        if ($response->tradeSuccess()) {
            return $this->sendConfigResponse($request, $response, $payment);
        } else {
            return $this->sendConfigFailedResponse($request, $response);
        }
    }
}
