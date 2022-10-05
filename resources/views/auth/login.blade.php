@extends('layouts.auth')

@section('content')
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
                                <div class="login-form-links">
                                    <div class="float-right"><a href="{{route('register')}}">注册账号</a></div>
                                    <div class="float-left"><a href="{{route('password.request')}}">忘记密码?</a></div>
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
@stop

@section('foot')
    <script type="text/javascript">
        var timer = null;

        function polling() {
            $.ajax({
                url: '/login/chklogin',
                dataType: 'json',
                success: function (res) {
                    if (res.result.user) {
                        clearTimeout(timer);
                        window.location.href = '/biz';
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
@stop
