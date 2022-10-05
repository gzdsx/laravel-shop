<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/auth/index.css?v='.config('app.version'))}}" rel="stylesheet" type="text/css">
</head>
<body style="background-image: url({{asset('images/auth/bg3.jpg')}})">
<div class="header-container">
    <div class="header">
        <div class="logo">小哥代跑</div>
        <div class="logo-desc">一个神奇的网站</div>
        <div class="flex-fill"></div>
        @if (auth()->check())
            <div>
                <span>{{auth()->user()->username}}</span>
                <a href="{{url('logout')}}">退出</a>
            </div>
        @endif
    </div>
</div>
<div class="login-wrapper">
    <div class="area align-center">
        <div class="flex-column justify-content-center h400">
            <div>
                <a href="{{url('regional/login')}}" style="margin-right: 20px">
                    <span class="btn btn-primary btn-lg w200">代理登录</span>
                </a>
                <a href="{{url('biz/login')}}">
                    <span class="btn btn-primary btn-lg w200">商家登录</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div>{{setting('copyright')}} {{setting('icp')}} <a href="{{admin_url()}}">后台入口</a></div>
</div>
</body>
</html>
