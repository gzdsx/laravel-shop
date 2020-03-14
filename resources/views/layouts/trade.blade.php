<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '买买买')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/trade/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
@include('common.top')
<div class="header">
    <div class="area banner">
        <div class="global-logo">
            <img src="{{asset('images/common/logo.png')}}">
        </div>
    </div>
</div>
@yield('content', '')

@include('common.footer')

@yield('foot')
</body>
</html>
