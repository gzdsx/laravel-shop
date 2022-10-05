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
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/auth/index.css?v='.config('app.version'))}}" rel="stylesheet" type="text/css">
@yield('styles')
    <script src="{{asset('js/lib/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/common.js')}}" type="text/javascript"></script>
@yield('scripts')
</head>
<body class="@yield('bodyClass', '')">
<div class="header-container">
    <div class="header">
        <div class="flex-row">
            <div class="logo">小哥代跑</div>
            <div class="logo-desc">商户线上经营平台</div>
        </div>
    </div>
</div>
@yield('content')

<div class="footer">
    <div>{{settings('copyright')}} {{settings('icp')}}</div>
</div>
@yield('foot')
</body>
</html>
