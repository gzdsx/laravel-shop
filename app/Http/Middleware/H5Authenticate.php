<?php

namespace App\Http\Middleware;

use Closure;
use Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate;

class H5Authenticate extends OAuthAuthenticate
{
    public function handle($request, Closure $next, $account = 'default', $scope = null, $type = 'service')
    {
        if (!auth()->check()) {
//            if (is_wechat()) {
//                return parent::handle($request, $next, $account, $scope, $type);
//            } else {
//                return redirect()->guest(route('signin'));
//            }

            return redirect()->guest(route('signin'));
        }

        return $next($request);
    }
}
