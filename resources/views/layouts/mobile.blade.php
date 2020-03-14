<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '粗耕微商城')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/mobile.css?'.time())}}" type="text/css">
    @yield('styles')
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/mobile/jquery.mobile.touch.min.js')}}" type="text/javascript"></script>
    <script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
    <script src="{{asset('js/mobile/weixin.js')}}" type="text/javascript"></script>
    @yield('scripts')
    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>
</head>
<body>
<div class="app" id="app">
    @yield('content', '')
</div>
@yield('foot', '')
<script type="text/javascript">
    $("[data-link]").on('click', function () {
        if ($(this).attr('data-link')){
            window.location.href = $(this).attr('data-link');
        }
    });
</script>
</body>
</html>
