@extends('layouts.auth')

@section('title', '账户注册')

@section('content')
<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        {{__('账号注册')}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-md-2 col-form-label text-md-right">昵称</label>

                                <div class="col-md-5">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4">可以是汉字、英文字母数字和下划线组合，不能含有符号</div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('手机号码') }}</label>

                                <div class="col-md-5">
                                    <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4">11位有效手机号码</div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('登录密码') }}</label>

                                <div class="col-md-5">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4">6-20位字符</div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('确认密码') }}</label>

                                <div class="col-md-5">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                <div class="col-md-4">两次密码要输入一致哦</div>
                            </div>

                            <div class="row">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('') }}</label>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-danger btn-lg btn-submit w-50">
                                        {{ __('注册') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('') }}</label>
                                <div class="col-md-5">
                                    <div class="links"><a href="{{route('login')}}">使用已有账号登录</a></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
