@extends('layouts.h5')

@section('title', '邀请码')

@section('content')
    <style type="text/css">html,body{background-color: #C8161D;}</style>
    <div class="app invite">
        <div class="logo">
            <img src="{{asset('images/common/logo.png')}}">
        </div>
        <div class="invite-title">基于区块链的社交零售领导者 </div>

        <div class="white-area">
            <div class="title">您的邀请码</div>
            <h1>{{$code}}</h1>

            {{--<div class="text-center">--}}
                {{--<div class="btn-invite">复制</div>--}}
            {{--</div>--}}
            <div class="blank"></div>
            <div class="red-line">
                <div class="circle" style="left: -35px;"></div>
                <div class="circle" style="right: -35px;"></div>
            </div>

            <div class="qrcode">
                <img src="{{$qrcode}}">
            </div>

            <div class="qrcode-tips">长按可保存海报，也可直接扫码注册</div>
        </div>
    </div>
@stop
