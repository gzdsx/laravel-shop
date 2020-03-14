@extends('layouts.h5')

@section('title', '个人中心')

@section('content')
<div class="user-header">
    <div class="avatar" style="background-image: url({{avatar($uid)}})"></div>
    <div class="username">{{$username}}</div>
</div>
    <div class="user-body">
        <div class="section-title" data-link="{{url('h5/bought')}}">
            <div class="text">我的订单</div>
            <div class="detail">全部订单></div>
        </div>

        <div class="grid-view">
            <div class="cell-item" data-link="{{url('h5/bought?tradeCode=waitPay')}}">
                <span class="ico">
                    <img src="{{asset('images/h5/user/wait-pay.png')}}">
                    @if($waitPay)<span class="badge">{{$waitPay}}</span>@endif
                </span>
                <div class="tit">待付款</div>

            </div>
            <div class="cell-item" data-link="{{url('h5/bought?tradeCode=waitSend')}}">
                <span class="ico">
                    <img src="{{asset('images/h5/user/wait-send.png')}}">
                    @if($waitSend)<span class="badge">{{$waitSend}}</span>@endif
                </span>
                <div class="tit">待发货</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/bought?tradeCode=waitConfirm')}}">
                <span class="ico">
                    <img src="{{asset('images/h5/user/send.png')}}">
                    @if($waitConfirm)<span class="badge">{{$waitConfirm}}</span>@endif
                </span>

                <div class="tit">已发货</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/bought?tradeCode=waitRate')}}">
                <span class="ico">
                    <img src="{{asset('images/h5/user/evaluate.png')}}">
                    @if($waitRate)<span class="badge">{{$waitRate}}</span>@endif
                </span>
                <div class="tit">待评价</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/bought?tradeCode=refunding')}}">
                <span class="ico">
                    <img src="{{asset('images/h5/user/refund.png')}}">
                    @if($refunding)<span class="badge">{{$refunding}}</span>@endif
                </span>
                <div class="tit">售后/退款</div>
            </div>
        </div>
        <div class="section-title">
            <div class="text">我的服务</div>
        </div>

        <div class="grid-view menus">
            <div class="cell-item" data-link="{{url('h5/game')}}">
                <img src="{{asset('images/h5/user/chayuan.png')}}" class="ico">
                <div class="tit">我的茶园</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/game/point')}}">
                <img src="{{asset('images/h5/user/duofen.png')}}" class="ico">
                <div class="tit">茶多分</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/commission')}}">
                <img src="{{asset('images/h5/user/yongjin.png')}}" class="ico">
                <div class="tit">我的佣金</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/invite')}}">
                <img src="{{asset('images/h5/user/yaoqinghaoyou.png')}}" class="ico">
                <div class="tit">邀请好友</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/team')}}">
                <img src="{{asset('images/h5/user/tuandui.png')}}" class="ico">
                <div class="tit">我的团队</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/point')}}">
                <img src="{{asset('images/h5/user/wdjf.png')}}" class="ico">
                <div class="tit">我的积分</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/collect')}}">
                <img src="{{asset('images/h5/user/shoucang.png')}}" class="ico">
                <div class="tit">收藏</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/myshop')}}">
                <img src="{{asset('images/h5/user/shangwuhezuo.png')}}" class="ico">
                <div class="tit">商务合作</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/shop')}}">
                <img src="{{asset('images/h5/user/fujin.png')}}" class="ico">
                <div class="tit">附近的店</div>
            </div>
            <div class="cell-item" data-link="{{url('h5/address')}}">
                <img src="{{asset('images/h5/user/dizhi.png')}}" class="ico">
                <div class="tit">地址管理</div>
            </div>

            <div class="cell-item">
                <a href="http://www.zph298.com/dialog.html?h=http%3A%2F%2Fg4.pop800.com&n=423141&l=cn">
                    <img src="{{asset('images/h5/user/zaixiankefu.png')}}" class="ico">
                    <div class="tit">在线客服</div>
                </a>
            </div>
            <div class="cell-item" data-link="{{url('h5/security')}}">
                <img src="{{asset('images/h5/user/shezhi.png')}}" class="ico">
                <div class="tit">设置</div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    @include('h5.tabbar')
@stop
