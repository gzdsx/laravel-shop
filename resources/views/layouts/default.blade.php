<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', settings('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', settings('keywords'))">
    <meta name="description" content="@yield('description', settings('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('lib/bootstrap/bootstrap.min.css?v=4.6.4')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('lib/bootstrap-icons/bootstrap-icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('lib/swiper/swiper-bundle.css?v=8.4.7')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dist/web/index.css?v='.appversion())}}" rel="stylesheet" type="text/css">
@yield('styles')
    <script src="{{asset('lib/jquery.min.js?v=1.12.4')}}" type="text/javascript"></script>
    <script src="{{asset('lib/swiper/swiper-bundle.min.js?v=8.4.7')}}" type="text/javascript"></script>
@yield('scripts')
</head>
<body class="@yield('body_class')">
@include('web.header')

<main class="main">
    @yield('content')
</main>

@include('web.footer')

@yield('foot')
</body>
</html>
