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
    <link rel="stylesheet" href="{{asset('css/vendor/vant.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/h5/index.css?'.time())}}" type="text/css">
    @yield('styles')
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript"></script>
    <script type="text/javascript">
        var global_config = {
            uid:'{{$uid}}',
            username:'{{$username}}'
        };
        wx.config(@json($jssdk_config));
        wx.error(function(res){
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
            //alert(JSON.stringify(res));
        });
    </script>
    @yield('scripts')
</head>
<body>
<div id="app" class="app">@yield('content')</div>
@yield('foot')
</body>
</html>
