<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="keywords" content="@yield('keywords', settings('keywords'))">
    <meta name="description" content="@yield('description', settings('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="format-detection" content="telephone=yes" />
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('lib/iconfont/iconfont.css')}}" rel="stylesheet">
    <link href="{{asset('dist/h5/index.css?v='.appversion())}}" rel="stylesheet">
@yield('styles')
    <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js" type="text/javascript"></script>
@if (is_wechat())
    <script type="text/javascript">
        wx.config(@json($jssdk_config));
        wx.error(function(res){
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
            //alert(JSON.stringify(res));
        });
    </script>
@endif
    <script type="text/javascript">
        window.isSignined = '{{auth()->check() ? '1' : '0'}}';
        window.ua = navigator.userAgent.toLowerCase();
        window.isWechat = ua.indexOf('micromessenger') !== -1;
        window.wechatAppid = '';
        window.openid = '{{session('wechat_oauth_user.openid')}}';
        window.baseUrl = '{{url('')}}';
        window.imgPath = '{{url('images')}}';
        window.qrcode = '{!! settings('wechat_qrcode') !!}';
    </script>
@yield('scripts')
</head>
<body>
<div id="app">@yield('content')</div>
@yield('foot')
</body>
</html>
