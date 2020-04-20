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
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/shop/index.css?v='.time())}}" rel="stylesheet" type="text/css">
    @yield('styles')
    <script src="{{asset('js/env-bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/vue.min.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
@include('common.top')
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
@yield('foot')
</body>
</html>
