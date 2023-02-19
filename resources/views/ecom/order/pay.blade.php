@extends('layouts.order')

@section('title', '支付订单')

@section('content')
    <div class="area">
        <div class="order-pay-info">
            <table class="order-table">
                <colgroup>
                    <col width="50">
                    <col>
                    <col width="80">
                    <col width="80">
                    <col width="80">
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>商品名称</th>
                    <th>单价</th>
                    <th>数量</th>
                    <th>合计</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->order_fee}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="h50"></div>
            <h3>订单信息</h3>
            <div class="order-pay-info-block">
                <div class="info-row">
                    <div class="info-row-label">订单编号</div>
                    <div class="info-row-value">{{$order->order_no}}</div>
                </div>
                <div class="info-row">
                    <div class="info-row-label">订单金额</div>
                    <div class="info-row-value">{{$order->order_fee}}</div>
                </div>
                <div class="info-row">
                    <div class="info-row-label">创建时间</div>
                    <div class="info-row-value">{{$order->created_at}}</div>
                </div>
                <div class="info-row">
                    <div class="info-row-label">交易流水</div>
                    <div class="info-row-value">{{$order->transaction['out_trade_no']}}</div>
                </div>
            </div>
            <div class="h20"></div>
            <h3>付款方式</h3>
            <div class="pay-types">
                <a href="{{url('order/wechatpay?order_id='.$order->order_id)}}">
                    <div class="pay-type-item">
                        <img src="{{asset('images/common/wxpay.png')}}" class="icon" alt="">
                        <span>微信支付</span>
                    </div>
                </a>
                <a href="{{url('order/alipay?order_id='.$order->order_id)}}">
                    <div class="pay-type-item">
                        <img src="{{asset('images/common/alipay.png')}}" class="icon" alt="">
                        <span>支付宝支付</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@stop
