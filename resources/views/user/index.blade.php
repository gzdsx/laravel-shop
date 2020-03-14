@extends('layouts.user')

@section('title', '用户中心')

@section('content')
    <div class="wellcome-div">
        <div class="txt">{{$username}}, 欢迎你!</div>
    </div>
    <div class="mcenter-content-div" style="height:120px;">
        <div class="headimg-div">
            <div class="avatar"><img src="{{avatar($uid)}}"></div>
            <div class="a-setting"><a href="{{url('user/userinfo')}}">设置头像</a></div>
        </div>
        <div class="user-account">
            <div class="row">
                <div class="item">账户余额：<i>{{$wallet['balance'] or ''}}</i></div>
                <div class="item">可用积分：<i>{{$wallet['integral'] or ''}}</i></div>
                <div class="item">账户状态：<i>正常</i></div>
            </div>
            <div class="row">
                <div class="item">
                    <a href="{{url('user/userinfo')}}"><span class="iconfont icon-my"></span>修改个人资料</a>
                </div>
                <div class="item" onclick="Plugins.showMapView()"><span class="iconfont icon-mobile"></span>手机已绑定</div>
                <div class="item"><span class="iconfont icon-mail"></span>邮箱已绑定</div>
            </div>
        </div>
    </div>
    <div id="coord"></div>
    <div class="mcenter-content-div">
        <div class="console-title"><strong>每日任务</strong></div>
    </div>

    <div class="mcenter-content-div">
        <div class="console-title"><strong>邀请好友</strong></div>
    </div>
@stop
