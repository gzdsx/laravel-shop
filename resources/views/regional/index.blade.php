<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', setting('sitename'))</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/element-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/index.css?v='.config('app.version'))}}" rel="stylesheet">
    <script src="{{asset('js/lib/wangEditor.min.js?v='.config('app.version'))}}" type="text/javascript"></script>
</head>
<body>
<div id="app"></div>
<script src="{{asset('js/lib/vue-chunk.js?v='.config('app.version'))}}" type="text/javascript"></script>
<script src="{{asset('js/lib/vue-router.min.js?v='.config('app.version'))}}" type="text/javascript"></script>
<script src="{{asset('js/lib/element-ui.js?v='.config('app.version'))}}" type="text/javascript"></script>
<script src="{{asset('static/regional/app.js?v='.config('app.version'))}}" type="text/javascript"></script>
</body>
</html>
