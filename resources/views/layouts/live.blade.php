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
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/live/index.css?v='.config('app.version'))}}" rel="stylesheet" type="text/css">
@yield('styles')
    <script src="{{asset('js/lib/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/DPlayer.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/hls.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('swiper/js/swiper.min.js')}}" type="text/javascript"></script>
@yield('scripts')
</head>
<body>
@include('common.top',['navName'=>'live'])

@yield('content')

@include('common.footer')

@yield('foot')
</body>
</html>
