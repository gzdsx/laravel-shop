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
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/index.css?v='.time())}}" rel="stylesheet">
    <script src="{{asset('js/env-bootstrap.js')}}"></script>
    @yield('styles')
    @yield('scripts')
</head>
<body>
<div id="app">@yield('content')</div>
@yield('foot')
</body>
</html>
