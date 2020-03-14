<?php

namespace App\Http\Controllers\Api;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Wechat\MiniProgramService;
use App\Traits\Wechat\WechatPayManagers;
use Illuminate\Http\Request;

class MiniprogramController extends BaseController
{
    use WechatPayManagers;

    protected $userRepository;

    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        parent::__construct($request);
        $this->userRepository = $userRepository;
    }

    /**
     * 小程序登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function login(Request $request)
    {
        $code = $request->input('code');
        $session = $this->miniprogram()->auth->session($code);
        $wechatUserInfo = $request->input('wechatUserInfo');
        $wechatUserInfo['openid'] = $session['openid'] ?? null;
        $wechatUserInfo['unionid'] = $session['unionid'] ?? null;
        $wechatUserInfo['appid'] = $this->miniProgram()->config->get('app_id');

        $service = new MiniProgramService();
        $user = $service->register($wechatUserInfo);

        if ($this->getAppidForRequest()) {
            return ajaxReturn([
                'access_token' => $this->userRepository->getAccessToken($user),
                'userinfo' => $user->only(['uid', 'gid', 'username', 'email', 'mobile', 'avatar'])
            ]);
        }

        return ajaxReturn([
            'api_token' => $user->api_token,
            'openid' => $wechatUserInfo['openid'],
            'userinfo' => $user->only(['uid', 'gid', 'username', 'email', 'mobile', 'avatar'])
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getOpenid(Request $request)
    {
        $code = $request->input('code');
        $session = $this->miniprogram()->auth->session($code);
        return ajaxReturn(['openid' => $session['openid']]);
    }
}
