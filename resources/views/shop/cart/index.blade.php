<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', '购物车')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/cart/index.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
@include('common.top', ['navName'=>'shop'])
<div id="app"></div>
@include('common.footer')
<script src="{{asset('js/lib/vue-chunk.js?v='.config('app.version'))}}" type="text/javascript"></script>
<script src="{{asset('static/cart/app.js?v='.config('app.version'))}}" type="text/javascript"></script>
</body>
</html>
