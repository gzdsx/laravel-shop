<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/iconfont/iconfont.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/vendor/vant.css?v=2.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/h5/index.css?'.time())}}" type="text/css">
    @yield('styles')
    <script src="{{asset('js/lib/chunk-vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/vant.min.js')}}" type="text/javascript"></script>
    <script src="//res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript"></script>
    <script>var imgPath = '{{asset('images')}}';</script>
    @yield('scripts')
    @if ($issetOfficialAccount)
        <script type="text/javascript">
            wx.config(@json($jssdk_config));
            wx.error(function(res){
                // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
                //alert(JSON.stringify(res));
            });
        </script>
    @endif
</head>
<body>
<div id="app">@yield('content')</div>
@yield('foot')
</body>
</html>
