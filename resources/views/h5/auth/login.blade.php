@extends('layouts.h5')

@section('title', '登录')

@section('content')
    <div class="login">
        <div class="icon-div">
            <span class="iconfont icon-timefill"></span>
        </div>
        <div class="tips">确认要登录虎顺直播平台吗?</div>

        <div class="opr-area">
            <div class="weui-form__opr-area">
                <a href="{{url('h5/login/confirm?basestr='.$basestr)}}">
                    <span class="weui-btn weui-btn_primary w-100">确认</span>
                </a>
            </div>
            <div class="weui-form__opr-area">
                <a href="{{url('h5/login/cancel')}}">
                    <span class="weui-btn weui-btn_default w-100">取消</span>
                </a>
            </div>
        </div>
    </div>
@stop
