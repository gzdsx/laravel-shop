<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', settings('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', settings('keywords'))">
    <meta name="description" content="@yield('description', settings('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/element-ui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/order/index.css?v='.config('app.version'))}}" rel="stylesheet" type="text/css">
@yield('scripts')
</head>
<body>
<div class="header">
    <div class="area banner">
        <div class="global-logo">
            <a href="{{url('/')}}"><img src="{{settings('logo')}}" alt=""></a>
        </div>
        <ul class="order-stepbar">
            <li class="{{$step=='confirm' ? 'active' : ''}}"><span>1. 确认订单</span></li>
            <li class="{{$step=='pay' ? 'active' : ''}}"><span>2. 支付订单</span></li>
            <li class="{{$step=='success' ? 'active' : ''}}"><span>3. 支付完成</span></li>
            <li class="{{$step=='rate' ? 'active' : ''}}"><span>4. 双方互评</span></li>
        </ul>
    </div>
</div>
@yield('content', '')
@include('common.footer')
@yield('foot')
</body>
</html>
