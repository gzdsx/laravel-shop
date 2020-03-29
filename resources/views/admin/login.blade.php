<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>后台管理中心</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon"/>
    <link href="{{asset('css/vendor/bootstrap.css')}}" type="text/css" rel="stylesheet">
    <style type="text/css">
        * {
            outline: none;
        }

        .top {
            background-color: #222;
            height: 75px;
            display: block;
            color: #fff;
            padding-top: 15px;
        }

        .form-wrapper {
            width: 350px;
            display: block;
            margin: 0 auto;
            padding: 100px 0;
        }

        .form-group {
            margin: 25px 0;
            clear: both;
            display: block;
        }

        .form-group .form-control {
            height: 40px;
            font-size: 16px;
        }

        .form-group .invalid-feedback {
            font-size: 14px;
        }

        .form-group h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

    </style>
</head>
<body>
<div class="top">
    <div class="container">
        <h2>后台管理中心</h2>
    </div>
</div>

<div class="container">
    <div class="form-wrapper">
        <form id="Form" class="form" method="post" aria-label="{{__('登录')}}">
            @csrf
            <div class="form-group">
                <h3>管理账号</h3>
                <input type="text" name="account" id="account"
                       class="form-control{{$errors->has('account') ? ' is-invalid' : ''}}" value="{{old('account')}}"
                       placeholder="邮箱/手机号">
                @if ($errors->has('account'))
                    <div class="invalid-feedback" role="alert" id="accountFeedback">{{$errors->first('account')}}</div>
                @endif
            </div>
            <div class="form-group">
                <h3>登录密码</h3>
                <input type="password" name="password" id="password"
                       class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" value="{{old('password')}}"
                       placeholder="密码">
                @if ($errors->has('password'))
                    <div class="invalid-feedback" role="alert" id="accountFeedback">{{$errors->first('password')}}</div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn btn-danger btn-lg">登录</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
