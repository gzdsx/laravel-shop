<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>后台管理中心</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon"/>
    <style type="text/css">
        *{outline:none}*,body,html{word-wrap:break-word;word-break:break-all;box-sizing:border-box}body,html{padding:0;margin:0;color:#3c3c3c;font-family:PingFang SC,Microsoft YaHei,Hiragino Sans GB,Arial,sans-serif;font-size:.9rem;line-height:1.6;background:#fff}dd,dl,dt,h1,h2,h3,h4,h5,li,p,ul{padding:0;margin:0;list-style:none}dd:after,div:after,dl:after,dt:after,h1:after,h2:after,h3:after,h4:after,h5:after,li:after,ol:after,p:after,ul:after{clear:both;content:" ";display:block;overflow:hidden}.top{background-color:#222;height:75px;display:block;color:#fff;padding-top:15px}.top h2{font-size:30px}.container{display:flex;width:1100px;margin:0 auto}.form-wrapper{width:350px;display:block;margin:0 auto;padding:100px 0}.form-group{margin:25px 0;clear:both;display:block}.form-group .form-control{height:40px;font-size:16px;width:100%;padding:.375rem .75rem;font-weight:400;line-height:1.6;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}.form-group .form-control:focus{border-color:#6cb2eb}.form-group .invalid-feedback{font-size:14px;color:#e3342f;margin-top:3px}.form-group h3{font-size:16px;margin-bottom:5px}.form-group .btn-login{background-color:#e3342f;color:#fff;border:0}.form-group .btn-login:hover{color:#fff;background-color:#c82333;border-color:#bd2130}
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
                <input type="text" name="account"
                       class="form-control{{$errors->has('account') ? ' is-invalid' : ''}}" value="{{old('account')}}"
                       placeholder="邮箱/手机号" required>
                @if ($errors->has('account'))
                    <div class="invalid-feedback" role="alert" id="accountFeedback">{{$errors->first('account')}}</div>
                @endif
            </div>
            <div class="form-group">
                <h3>登录密码</h3>
                <input type="password" name="password"
                       class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" value="{{old('password')}}"
                       placeholder="密码" required>
                @if ($errors->has('password'))
                    <div class="invalid-feedback" role="alert" id="accountFeedback">{{$errors->first('password')}}</div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn-login">登录</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
