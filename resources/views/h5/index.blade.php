<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', settings('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', settings('keywords'))">
    <meta name="description" content="@yield('description', settings('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="format-detection" content="telephone=yes" />
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('lib/iconfont/iconfont.css')}}" rel="stylesheet">
    <link href="{{asset('lib/vant/vant.min.css')}}" rel="stylesheet">
    <link href="{{asset('dist/h5/index.css?v='.appversion())}}" rel="stylesheet">
@yield('styles')
    <script src="{{asset('lib/vue/vue-chunk.js?v='.appversion())}}" type="text/javascript"></script>
    <script src="{{asset('lib/vue/vue-router.min.js?v='.appversion())}}" type="text/javascript"></script>
    <script src="{{asset('lib/vant/vant.min.js?v='.appversion())}}" type="text/javascript"></script>
    <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js" type="text/javascript"></script>
    <script src="https://map.qq.com/api/gljs?v=1.exp&key={{env('TMAP_KEY')}}" charset="utf-8"></script>
    <script src="https://apis.map.qq.com/tools/geolocation/min?key={{env('TMAP_KEY')}}&referer={{settings('sitename')}}" charset="utf-8"></script>
    <script type="text/javascript">
        window.isSignined = '{{auth()->check() ? '1' : '0'}}';
        window.ua = navigator.userAgent.toLowerCase();
        window.isWechat = ua.indexOf('micromessenger') != -1;
        window.appId = '{{env('WECHAT_OFFICIAL_ACCOUNT_APPID')}}';
        window.imgPath = '{{url('images')}}';
        window.qrcode = '{!! settings('wechat_qrcode') !!}';
        window.tmapKey = '{{env('TMAP_KEY')}}';
        window.logo = '{{asset('images/common/logo.png')}}';
        window.siteName = '{{settings('sitename')}}';
    </script>
    <script type="text/javascript">
        wx.config(@json($jssdk_config));
        wx.error(function(res){
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名
            console.log(res);
        });
    </script>
@yield('scripts')
</head>
<body>
<div id="app"></div>
<script src="{{asset('dist/h5/index.js?v='.appversion())}}" type="text/javascript"></script>
</body>
</html>
