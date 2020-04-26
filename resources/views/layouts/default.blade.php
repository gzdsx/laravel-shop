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
    <link href="{{asset('css/index/index.css?v='.time())}}" rel="stylesheet" type="text/css">
    @yield('styles')
    <script src="{{asset('js/env-bootstrap.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
@include('common.top')
<div class="header">
    <div class="area banner">
        <div class="global-logo">
            <img src="{{asset('images/common/logo.png')}}">
        </div>
        <div class="global-search-box">
            <form method="get" action="{{url('search')}}">
                <div class="input-box">
                    <input type="text" class="text" placeholder="商品名称" name="q" value="{{request('q')}}">
                    <input type="submit" class="btn" value="搜索">
                </div>
            </form>
            <div class="hot">
                热门搜索:
                <a href="{{url('item/search?q=花菜')}}">花菜</a>、
                <a href="{{url('item/search?q=胡萝卜')}}">胡萝卜</a>、
                <a href="{{url('item/search?q=五花肉')}}">五花肉</a>
            </div>
        </div>
        {{--<ul class="apps">--}}
        {{--<li>--}}
        {{--<div class="pic showqrcode"><img src="{{asset('images/common/weixin_qrcode.jpg')}}"></div>--}}
        {{--<p>在微信关注我们</p>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<div class="pic showqrcode"><img src="{{asset('images/common/app_qrcode.jpg')}}"></div>--}}
        {{--<p>下载粗耕APP</p>--}}
        {{--</li>--}}
        {{--</ul>--}}
    </div>
</div>
<div class="global-nav">
    <div class="nav">
        <ul>
            <li><a href="{{url('/')}}">首页</a></li>
            <li><a href="{{url('youxuan')}}">正品优选</a></li>
            <li><a href="{{url('user/#/bought')}}">我的订单</a></li>
        </ul>
    </div>
</div>
@yield('content')

@include('common.footer')

@yield('foot')
</body>
</html>
