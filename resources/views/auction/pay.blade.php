@extends('layouts.auction')

@section('title', '支付订单')

@section('content')
    <div class="area">
        <h3>订单信息</h3>
        <div class="pay-order-info">
            <div class="item-info">
                <div class="order-field">订单编号</div>
                <div class="order-info">{{$order['order_no']}}</div>
            </div>
            <div class="item-info">
                <div class="order-field">订单金额</div>
                <div class="order-info">{{$order['total_fee']}}</div>
            </div>
            <div class="item-info">
                <div class="order-field">下单时间</div>
                <div class="order-info">{{$order['created_at']}}</div>
            </div>
            <div class="item-info">
                <div class="order-field">交易流水</div>
                <div class="order-info">{{$transaction['transaction_no']}}</div>
            </div>
        </div>

        <h3>付款方式</h3>
        <div class="pay-types">
            <div class="pay-type">
                <img src="{{asset('images/common/balancepay.png')}}" class="icon">
                <span>余额支付</span>
            </div>
            <div class="pay-type" @click="alipay()">
                <img src="{{asset('images/common/alipay.png')}}" class="icon">
                <span>支付宝</span>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            methods:{
                alipay:function (){
                    window.location.href = '{{url('auction/pay/alipay?order_id='.$order_id)}}';
                }
            }
        });
    </script>
@stop
