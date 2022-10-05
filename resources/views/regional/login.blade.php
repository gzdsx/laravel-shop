<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/auth/index.css?v='.config('app.version'))}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/lib/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/common.js')}}" type="text/javascript"></script>
</head>
<body class="regional">
<div class="header-container">
    <div class="header">
        <div class="flex-row">
            <div class="logo">小哥代跑</div>
            <div class="logo-desc">区域代理管理平台</div>
        </div>
    </div>
</div>
<div class="login-wrapper">
    <div class="area align-center">
        <div class="login-form">
            <div class="login-form-inner">
                <div class="login-tabs" id="login-tabs">
                    <div class="login-tab-item login-tab-active">账号登录</div>
                    <div class="login-tab-item">扫码登录</div>
                </div>
                <div id="login-contents">
                    <div class="login-type">
                        <form method="post">
                            @csrf
                            <div class="login-form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="btn btn-default">
                                            <div class="iconfont icon-people"></div>
                                        </div>
                                    </div>
                                    <input type="text" name="account"
                                           class="form-control textinput{{$errors->has('account') ? ' is-invalid' : ''}}"
                                           placeholder="手机号/邮箱" required="required">
                                    @if ($errors->has('account'))
                                        <div class="invalid-feedback show"
                                             role="alert">{{$errors->first('account')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="login-form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="btn btn-default">
                                            <div class="iconfont icon-lock"></div>
                                        </div>
                                    </div>
                                    <input type="password" name="password"
                                           class="form-control textinput{{$errors->has('password') ? ' is-invalid' : ''}}"
                                           placeholder="登录密码" required="required">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback show"
                                             role="alert">{{$errors->first('password')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="login-form-group">
                                <button type="submit" class="btn btn-danger btn-login">登录</button>
                            </div>
                        </form>
                    </div>

                    <div class="login-type" style="display: none;">
                        <img src="{{url('login/appcode')}}" alt=""/>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div>{{setting('copyright')}} {{setting('icp')}}</div>
</div>

<script type="text/javascript">
    var timer = null;

    function polling() {
        $.ajax({
            url: '/login/chklogin',
            dataType: 'json',
            success: function (res) {
                if (res.result.user) {
                    clearTimeout(timer);
                    window.location.href = '/regional';
                } else {
                    timer = setTimeout(polling, 1000);
                }
            }
        });
    }

    $("#login-tabs>.login-tab-item").click(function () {
        $(this).addClass('login-tab-active').siblings().removeClass('login-tab-active');
        $("#login-contents>div").eq($(this).index()).show().siblings().hide();

        if ($(this).index() === 1) {
            polling();
        } else {

        }
    });
</script>
</body>
</html>
