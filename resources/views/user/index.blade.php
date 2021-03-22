<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', '用户中心')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/vendor/element-ui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/user/index.css?v='.config('app.version'))}}" rel="stylesheet" type="text/css">
</head>
<body>
@include('common.top',['navName'=>'user'])
<div class="user">
    <div id="app"></div>
</div>
@include('common.footer')
<script src="{{asset('js/lib/vue-chunk.js?v='.config('app.version'))}}" type="text/javascript"></script>
<script src="{{asset('js/lib/vue-router.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('static/user/app.js?v='.config('app.version'))}}" type="text/javascript"></script>
</body>
</html>
