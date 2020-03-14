<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/auction/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
<div id="app">
    @include('common.top')
    <div class="header">
        <div class="area banner">
            <div class="global-logo">
                <img src="{{asset('images/common/logo.png')}}">
            </div>
            <ul class="order-stepbar">
                <li @if($step=='confirmOrder')class="cur"@endif><span>1. 确认订单</span></li>
                <li @if($step=='payOrder')class="cur"@endif><span>2. 支付订单</span></li>
                <li @if($step=='paySuccess')class="cur"@endif><span>3. 支付完成</span></li>
                <li @if($step=='rate')class="cur"@endif><span>4. 双方互评</span></li>
            </ul>
        </div>
    </div>
    @yield('content', '')
    @include('common.footer')
</div>
@yield('foot')
</body>
</html>
