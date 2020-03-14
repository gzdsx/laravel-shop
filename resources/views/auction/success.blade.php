@extends('layouts.auction')

@section('title', '支付结果')

@section('content')
    <div class="pay-result">
        <div class="inner">
            @if($order['pay_state'])
            <h2>订单支付成功</h2>
            <div class="iconfont icon-roundcheck"></div>
            <p>
                <span class="order-no">订单号:{{$order['order_no']}}</span>
                <span class="amount">支付金额:<i>￥{{$order['total_fee']}}</i></span>
            </p>
            <p class="links">
                <a href="{{url('user/trade/detail?order_id='.$order_id)}}" style="margin-right: 50px;">订单详情</a>
                <a href="{{url('/')}}">继续购物</a>
            </p>
            @else
            <h2>付款未完成</h2>
            <div class="iconfont icon-roundclose"></div>
            <p>
                <span class="order-no">订单号:{{$order['order_no']}}</span>
                <span class="amount">支付金额:<i>￥{{$order['total_fee']}}</i></span>
            </p>
            <p class="links">
                <a href="{{url('auction/pay?order_id='.$order_id)}}" style="margin-right: 50px;">立即支付</a>
                <a href="{{url('user/trade/detail?order_id='.$order_id)}}"git style="margin-right: 50px;">订单详情</a>
                <a href="{{url('/')}}">继续购物</a>
            </p>
            @endif
        </div>
    </div>
@stop
