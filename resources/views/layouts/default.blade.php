<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    @yield('styles')
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{mix('js/base.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
<div class="header-wrap">
    <div class="header-fix">
        <div class="header">
            <div class="header-right">
                @if($islogined)
                    <a href="/member" class="username">
                        <img src="{{avatar($uid, 'small')}}">
                        <span>{{$username}}</span>
                    </a>
                @else
                <a href="/account/login" class="link-button">登录</a>
                <a href="/account/register" class="link-button">注册</a>
                @endif
            </div>
            <div class="logo">
                <img src="{{asset('images/common/logo.png')}}">
            </div>
            <ul class="nav">
                <li><a href="{{url('/')}}">首页</a></li>
                <li><a href="/post/list?catid=15">动态</a></li>
                <li><a href="/post/list?catid=16">活动</a></li>
                <li><a href="/join">招新</a></li>
                <li><a href="/job">人才</a></li>
            </ul>
        </div>
    </div>
</div>

@yield('content')

<div id="footer">
    <div class="area">
        <div class="bottomNav">
            <a href="javascript:;">关于我们</a><span>|</span>
            <a href="javascript:;">联系方式</a><span>|</span>
            <a href="javascript:;">广告服务</a><span>|</span>
            <a href="javascript:;">法律援助</a><span>|</span>
            <a href="javascript:;">加入我们</a><span>|</span>
            <a href="javascript:;">支付方式</a><span>|</span>
            <a href="javascript:;">技术支持</a>
        </div>

        <div class="copyright">{{setting('copyright')}}   {{setting('icp')}}</div>
    </div>
</div>
</body>
</html>
