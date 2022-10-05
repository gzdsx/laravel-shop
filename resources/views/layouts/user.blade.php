<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', '用户中心')</title>
    <meta name="keywords" content="@yield('keywords', settings('keywords'))">
    <meta name="description" content="@yield('description', settings('description'))">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/user/index.css')}}" rel="stylesheet" type="text/css">
@yield('styles')
    <script src="{{asset('js/lib/vue-chunk.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
@yield('scripts')
</head>
<body>
@include('common.top',['navName'=>'user'])

<div class="membercp-header">
    <div class="area header">
        <strong class="logo"><img src="{{asset('images/common/grzx_logo.png')}}"></strong>
        <div class="right-menu">
            <a href="{{url('/')}}">网店铺首页</a>
            <a href="{{url('user/#/userinfo')}}">账户中心</a>
            <a href="{{url('user/#/transaction')}}">财务中心</a>
        </div>
    </div>
</div>
<div style="height: 30px; display: block; clear: both;"></div>
<div class="area">
    <div class="sidebar">
        <div class="sidebar-content">
            <dl>
                <dd><a><i class="iconfont icon-formfill"></i>订单管理</a></dd>
                <dt>
                    <ul>
                        <li><a href="{{url('/user/bought')}}" @if($menu=='bought') class="cur"@endif>已买到的宝贝</a></li>
                    </ul>
                </dt>
            </dl>

            <dl>
                <dd><a><i class="iconfont icon-peoplefill"></i>我的账户</a></dd>
                <dt>
                    <ul>
                        <li><a href="{{url('/user/userinfo')}}" @if($menu=='userinfo') class="cur"@endif>资料设置</a></li>
                        <li><a href="{{url('/user/security')}}" @if($menu=='security') class="cur"@endif>账户安全</a></li>
                        <li><a href="{{url('/user/transaction')}}" @if($menu=='transaction') class="cur"@endif>我的账单</a>
                        </li>
                        <li><a href="{{url('/user/address')}}" @if($menu=='address') class="cur"@endif>收货地址</a></li>
                        <li><a href="{{url('/user/collect')}}" @if($menu=='collect') class="cur"@endif>我的收藏</a></li>
                    </ul>
                </dt>
            </dl>
        </div>
    </div>
    <div class="mainframe">
        <div class="main-content">
            <div id="app">@yield('content', '')</div>
        </div>
    </div>
</div>
@include('common.footer')
@yield('foot')
</body>
</html>
