<?php

namespace App\Http\Middleware;

use App\Events\UserEvent;
use App\Models\User;
use App\Models\UserConnect;
use App\Models\UserGroup;
use App\WeChat\WechatDefaultConfig;
use App\WeChat\WechatOauthUser;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class WechatAuthenticate
{
    use WechatDefaultConfig;
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            $app  = $this->officialAccount();
            if ($request->has('code') && $request->has('state')){
                $user = new WechatOauthUser($app->oauth->user()->getOriginal());
                $connect = UserConnect::where('openid', $user->openid())->first();
                if ($connect) {
                    if ($connect->user) {
                        Auth::loginUsingId($connect->uid);
                        Auth::user()->update(['username'=>$user->nickname()]);
                        $connect->update([
                            'nickname'=>$user->nickname(),
                            'gender'=>$user->sex(),
                            'city'=>$user->city(),
                            'province'=>$user->province(),
                            'country'=>$user->country(),
                            'avatar'=>$user->headimgurl(),
                            'updated_at'=>time()
                        ]);
                        $request->offsetSet('src', 'wechat');
                        event(new UserEvent(Auth::user(), 'login'));
                    } else {
                        $connect->delete();
                        $this->RegisterUser($request, $user);
                    }
                } else {
                    $this->RegisterUser($request, $user);
                }
                session(['wechat.oauth_user'=>$user->userinfo()]);
                $this->syncHeadImg(Auth::id(), $user->headimgurl());
            } else {
                return $app->oauth->scopes(['snsapi_userinfo'])->setRedirectUrl(URL::full())->redirect();
            }
        }
        return $next($request);
    }

    private function RegisterUser(Request $request, WechatOauthUser $info)
    {
        $request->offsetSet('src', 'wechat');
        $user = User::create([
            'username'=>$info->nickname(),
            'password'=>Hash::make(''),
            'created_at'=>time(),
            'gid'=>UserGroup::userGroups()->orderBy('creditslower')->first()->gid
        ]);

        if ($user) {
            $user->connects()->create([
                'platform'=>'weixin',
                'openid'=>$info->openid(),
                'nickname'=>$info->nickname(),
                'gender'=>$info->sex(),
                'city'=>$info->city(),
                'province'=>$info->province(),
                'country'=>$info->country(),
                'avatar'=>$info->headimgurl(),
                'created_at'=>time()
            ]);
        }

        Auth::loginUsingId($user->uid);
        event(new UserEvent(Auth::user(), 'register'));
    }

    private function syncHeadImg($uid, $uri){
        ignore_user_abort(true);
        $client = new Client();
        $response = $client->get($uri);
        $handle = Image::make($response->getBody());
        $avatarPath = material_path('avatar/'.$uid);
        @mkdir($avatarPath, 0777, true);
        $handle->resize(300, 300)->save($avatarPath.'/big.png');
        $handle->resize(150, 150)->save($avatarPath.'/middle.png');
        $handle->resize(50, 50)->save($avatarPath.'/small.png');
        return true;
    }
}
