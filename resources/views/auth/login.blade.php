@extends('layouts.auth')

@section('content')
    <div class="form-body bg-cover">
        <div class="container position-relative">
            <div class="form-container">
                <div class="form-content">
                    <div class="form-header"><h4>会员登录</h4></div>
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="btn btn-default">
                                        <div class="iconfont icon-people"></div>
                                    </div>
                                </div>
                                <input type="text" name="account" class="form-control{{$errors->has('account') ? ' is-invalid' : ''}}" placeholder="手机号/邮箱" required="required">
                                @if ($errors->has('account'))
                                    <div class="invalid-feedback show" role="alert">{{$errors->first('account')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="btn btn-default">
                                        <div class="iconfont icon-lock"></div>
                                    </div>
                                </div>
                                <input type="password" name="password" class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" placeholder="登录密码" required="required">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback show" role="alert">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="form-control btn btn-danger btn-submit">登录</button>
                        </div>
                        <div class="links">
                            <div class="float-right"><a href="{{route('register')}}">注册账号</a></div>
                            <div class="float-left"><a href="{{route('password.request')}}">忘记密码?</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
