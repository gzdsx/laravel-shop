<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '系统提示')</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="@yield('keywords', settings('keywords'))">
    <meta name="description" content="@yield('description', settings('description'))">
    <meta name="render" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <style type="text/css">
        *{outline:none}*,body,html{word-wrap:break-word;word-break:break-all;box-sizing:border-box}body,html{padding:0;margin:0;color:#3c3c3c;font-family:PingFang SC,Microsoft YaHei,Hiragino Sans GB,Arial,sans-serif;font-size:.9rem;line-height:1.6;background:#fff}dd,dl,dt,h1,h2,h3,h4,h5,li,p,ul{padding:0;margin:0;list-style:none}dd:after,div:after,dl:after,dt:after,h1:after,h2:after,h3:after,h4:after,h5:after,li:after,ol:after,p:after,ul:after{clear:both;content:" ";display:block;overflow:hidden}dd,dt{font-weight:400}img{border:0}a,a:active,a:link,a:visited{color:#3c3c3c;text-decoration:none;cursor:pointer}a:hover{text-decoration:none;color:#008fbf}.app{display:block;padding:0;margin:0}.app .error-content{text-align:center;padding-top:100px;min-height:530px}.app .error-content .image{text-align:center;display:block}.app .error-content .image img{width:200px;display:inline-block}.app .error-content .error-icon{text-align:center}.app .error-content .error-icon img{width:80px;display:inline-block;margin-bottom:10px}.app .error-content h2{font-size:18px;font-weight:500;line-height:3.6}.app .error-content .links{text-align:center;font-size:14px}.app .error-content a{margin:0 5px;text-decoration:none}.app .error-content a:hover{text-decoration:underline}
    </style>
</head>
<body>
@yield('head')
<div class="app" id="app">
    <div class="error-content">
        @yield('content')
    </div>
</div>
@yield('foot')
</body>
</html>
