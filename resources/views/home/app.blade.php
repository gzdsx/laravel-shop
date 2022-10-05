<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>下载APP</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <script src="{{asset('js/lib/jquery.min.js')}}" type="text/javascript"></script>
    <style type="text/css">
        html,body{
            background-color: #1690C9;
            padding: 30px 0;
            margin: 0;
            color: #fff;
        }
        .icon-container{
            display: block;
            align-self: center;
            align-items: center;
            text-align: center;
        }

        .icon-container .icon{
            width: 80px;
            height: 80px;
            display: inline-block;
            border-radius: 10px;
        }

        .version{
            font-size: 14px;
            text-align: center;
            padding: 10px;
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 16px;
            text-align: center;
            color: #fff;
            border-radius: 10px;
            background-color: #00C858;
        }

        .button-container{
            display: block;
            margin: 30px 20px;
            text-align: center;
        }

        .title{
            font-size: 20px;
            padding: 30px 0;
            text-align: center;
        }
        .section-title{
            font-size: 16px;
            text-align: center;
        }
        .section{
            text-align: center;
            margin: 10px 20px;
        }

        .section img{
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="icon-container">
        <img src="{{asset('images/app/appicon.png')}}" class="icon" alt="">
    </div>
    <div class="version">v1.0.6</div>
    @if($platform === 'ios')
    <div class="button-container">
        <div class="button" id="appstore">去App Store下载</div>
    </div>
    @else
    <h3 class="title">下载方法</h3>
    <div class="section-title">第一步</div>
    <div class="section"><img src="{{asset('images/app/demo1.jpg')}}" alt=""></div>
    <div class="section-title">第二步</div>
    <div class="section"><img src="{{asset('images/app/demo2.jpg')}}" alt=""></div>
    @endif
<script>
    $("#appstore").on('click', function () {
        window.open('https://apps.apple.com/cn/app/id1544829486?l=zh&ls=1');
    });
</script>
</body>
</html>
