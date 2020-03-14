<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))-后台管理中心</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/index.css?'.time())}}" rel="stylesheet">
    @yield('styles')
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body style="padding: 20px;">
<div id="app">
    @yield('content')
</div>
<div class="blank-20"></div>
@yield('foot')
</body>
</html>
