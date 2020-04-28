<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '购物车')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/cart/index.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
@include('common.top', [])
<div class="header">
    <div class="area banner">
        <div class="global-logo">
            <img src="{{asset('images/common/logo.png')}}">
        </div>
        <div class="global-search-box">
            <form method="get" action="{{url('/search')}}">
                <div class="input-box">
                    <input type="text" class="text" placeholder="商品名称" name="q" value="{{request('q')}}">
                    <input type="submit" class="btn" value="搜索">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="app"></div>
@include('common.footer')
<script src="{{asset('js/lib/chunk-vendor.js')}}" type="text/javascript"></script>
<script src="{{asset('js/cart/app.js?v='.time())}}" type="text/javascript"></script>
</body>
</html>
