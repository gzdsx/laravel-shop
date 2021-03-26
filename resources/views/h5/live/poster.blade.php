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
    <style type="text/css">
        *{box-sizing: border-box;}
        html,body{
            padding: 0;
            margin: 0;
            max-width: 750px;
            line-height: 1.5;
            font-size: 16px;
        }

        .poster{
            background-image: url("{{asset('images/poster.png')}}");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            display: block;
            width: 740px;
            height: 1316px;
            color: #fff;
            position: relative;
        }

        .poster .avatar{
            width: 110px;
            height: 110px;
            border: 8px #ffffff solid;
            display: block;
            border-radius: 65px;
            left: 38px;
            top: 50px;
            position: absolute;
        }

        .poster .uname{
            position: absolute;
            top: 50px;
            right: 38px;
            text-align: right;
        }

        .poster .uname h1{
            font-size: 40px;
            line-height: 1;
        }

        .poster .uname p{
            font-size: 28px;
            line-height: 1;
        }
    </style>
</head>
<body>
<div class="poster">
    <img src="{{auth()->user()->avatar}}" class="avatar">
    <div class="uname">
        <h1>{{auth()->user()->username}}</h1>
        <p>邀请您来一起看直播</p>
    </div>
</div>
</body>
</html>
