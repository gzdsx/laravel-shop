<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/auth/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="{{url('/')}}"><img src="{{asset('images/common/logo.png')}}"></a>
        </div>
    </div>
</header>
@yield('content', '')

@include('common.footer')

@yield('foot')
</body>
</html>
