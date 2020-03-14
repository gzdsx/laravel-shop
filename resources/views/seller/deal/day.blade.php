@extends('layouts.seller')

@section('title', '交易设置')

@section('content')
    <div class="console-title">
        <h2>交易设置 >> 七天退货保障</h2>
    </div>
    @if ($shop->serven_day_return)
        <div class="alert alert-info">已经开通7天退货退款</div>
    @endif
    <div class="content-div">
        <h4>7天退货退款</h4>
        <p>已加入7天退货需要关闭此服务,请联系微店客服。开通期间已产生的订单,在关闭服务后,仍需按照7天退货处理。</p>
        <div class="blank"></div>
        <div class="pannel">
            <p>1.承诺在买家签收后7天内，可以在符合7天退货的条件下退款。如果没有明确签收时间的，以买家确认收货时间为准。</p>
            <p>2.只能使用“担保交易”服务进行交易，无法使用“直接到账”或者“货到付款”交易。</p>
            <p>4.你的买家可以主动发起退款，如果你在7天内不进行处理，退款将自动确认成功。</p>
            <p>5.你的买家可以主动发起退款，如果你在7天内不进行处理，退款将自动确认成功。</p>
            <p>6.在担保交易成功后，你的货款将继续被冻结7天，在超过7天退货期限后才能提现。</p>
        </div>
        <div style="padding: 20px 0;">
            @if ($shop->seven_day_return)
                <button class="btn btn-lg btn-secondary" @click="setSevenDayRetrun(0)">取消加入7天退货</button>
            @else
                <button class="btn btn-lg btn-danger" @click="setSevenDayRetrun(1)">确定加入7天退货</button>
            @endif
        </div>
    </div>
@stop

@section('foot')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
            methods: {
                setSevenDayRetrun: function (type) {
                    $.ajax({
                        type: 'POST',
                        data: {seven_day_return: type},
                        url:'{{seller_url('deal/update')}}',
                        success:function () {
                            window.location.href = '{{seller_url('deal')}}';
                        }
                    });
                }
            }
        });
    </script>
@stop
