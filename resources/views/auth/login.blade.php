@extends('layouts.auth')

@section('content')
    <div class="login-wrapper">
        <div class="area position-relative">
            <div class="login-form">
                <div class="login-form-inner">
                    <div class="login-form-header"><h4>会员登录</h4></div>
                    <form method="post">
                        @csrf
                        <div class="login-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="btn btn-default">
                                        <div class="iconfont icon-people"></div>
                                    </div>
                                </div>
                                <input type="text" name="account" class="form-control textinput{{$errors->has('account') ? ' is-invalid' : ''}}" placeholder="手机号/邮箱" required="required">
                                @if ($errors->has('account'))
                                    <div class="invalid-feedback show" role="alert">{{$errors->first('account')}}</div>
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
                                <input type="password" name="password" class="form-control textinput{{$errors->has('password') ? ' is-invalid' : ''}}" placeholder="登录密码" required="required">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback show" role="alert">{{$errors->first('password')}}</div>
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
            </div>
        </div>
    </div>
@stop
