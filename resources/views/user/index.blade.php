<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '用户中心')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/vendor/element-ui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/user/index.css?v='.time())}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/lib/chunk-vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
    <script type="text/javascript">window.user=@json($user);window.account=@json($account);</script>
</head>
<body>
@include('common.top')

<div class="membercp-header">
    <div class="area header">
        <strong class="logo"><img src="{{asset('images/common/grzx_logo.png')}}"></strong>
        <div class="right-menu">
            <a href="{{url('/')}}">店铺首页</a>
            <a href="#/userinfo">账户中心</a>
            <a href="#/transaction">财务中心</a>
        </div>
    </div>
</div>
<div class="h30"></div>
<div id="app"></div>
@include('common.footer')
<script type="text/javascript" src="{{asset('js/user/app.js?v='.time())}}"></script>
</body>
</html>
