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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/entry/index.css')}}" rel="stylesheet" type="text/css">
    @yield('styles')
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/mall.js')}}" type="text/javascript"></script>
    @yield('scripts')
    <script type="text/javascript">
        window.userStatus = {
            uid:'{{$uid}}',
            username:'{{$username}}'
        };
    </script>
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
                    <input type="text" class="text" placeholder="商品名称" name="q" value="{{$q ?? ''}}">
                    <input type="submit" class="btn" value="搜索">
                </div>
            </form>
            <div class="hot">
                热门搜索:
                <a href="{{url('/item/search?q=花菜')}}">花菜</a>、
                <a href="{{url('/item/search?q=胡萝卜')}}">胡萝卜</a>、
                <a href="{{url('/item/search?q=五花肉')}}">五花肉</a>
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
<script type="text/javascript">
    $(".showqrcode").mouseenter(function () {
        var src = $(this).find('img').attr('src');
        var offset = $(this).offset();
        var img = $("<img/>").width(200).height(200).attr('id','J-qrcode-preview').attr('src', src).appendTo(document.body);
        img.css({'z-index':9999, 'left':offset.left + $(this).width() - 200, 'top':offset.top+$(this).height(),'position':'fixed', 'border':'1px #DDD solid'});
    }).mouseleave(function () {
        $("#J-qrcode-preview").remove();
    });
</script>
<div class="global-nav">
    <div class="nav">
        <div class="cat"><a href="{{url('/item/catlog')}}"><span class="iconfont icon-sort"></span> 全部商品分类</a></div>
        <ul>
            <li><a href="{{url('/')}}"@if(isset($globalNav)&&$globalNav==='home') class="cur"@endif>首页</a></li>
            <li><a href="{{url('youxuan')}}"@if(isset($globalNav)&&$globalNav==='item') class="cur"@endif>正品优选</a></li>
            <li><a href="{{url('shop')}}"@if(isset($globalNav)&&$globalNav==='shop') class="cur"@endif>企业店铺</a></li>
            <li><a href="{{url('user/bought')}}">我的订单</a></li>
        </ul>
        <div class="cart" id="nav-cart">
            <a href="{{url('/cart')}}">
                <span class="ico"></span>
                <span>购物车{{intval(cookie('cart_total_count')->getValue())}}件</span>
                <strong>去结算>></strong>
            </a>
        </div>
    </div>
</div>

@yield('content', '')

@include('common.footer')

@yield('foot')
</body>
</html>
