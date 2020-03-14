@extends('layouts.h5')

@section('title', '订单详情')

@section('content')
    <div class="auction">
        <div class="shipping">
            <div class="ico"><span class="iconfont icon-location"></span></div>
            <div class="flex">
                <div class="display-flex">
                    <div class="flex">{{$shipping['consignee']}}</div>
                    <div>{{$shipping['phone']}}</div>
                </div>
                <div class="address">{{$shipping['province'].$shipping['city'].$shipping['district'].$shipping['street']}}</div>
            </div>
        </div>
        <div class="caitiao"></div>
        <div class="blank"></div>
        <div class="items">
            @foreach ($items as $item)
                <div class="list-item" data-link="{{h5_item_url($item['itemid'])}}">
                    <div class="image bg-cover" style="background-image: url({{image_url($item['thumb'])}})"></div>
                    <div class="content">
                        <div class="title">{{substring($item['title'], 28)}}</div>
                        <div class="subtitle">[商品属性]</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="price">￥{{$item['price']}}</div>
                            <div class="quantity">x{{$item['quantity']}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="weui-cells margin-top-0">
            <div class="weui-cell">
                <div class="weui-cell__bd">订单编号</div>
                <div class="weui-cell__ft fontsize-14">
                    {{$order['order_no']}}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">下单日期</div>
                <div class="weui-cell__ft fontsize-14">{{@date('Y-m-d H:i:s', $order['created_at'])}}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd" style="width: 120px !important;">
                    买家留言
                </div>
                <div class="weui-cell__bd"></div>
                <div class="weui-cell__ft fontsize-14" style="word-break: break-all; white-space: pre-wrap;">
                    {{$order['buyer_message'] ? $order['buyer_message'] : '此订单没有留言'}}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">订单金额</div>
                <div class="weui-cell__ft fontsize-14">￥{{$order['order_fee']}}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">运费</div>
                <div class="weui-cell__ft fontsize-14">+￥{{$order['shipping_fee']}}</div>
            </div>
        </div>
        <div class="blank"></div>
        <div class="kefu-area">
            <div class="btn-area flex">
                <div class="btn-square">
                    <a href="tel:{{$shop['phone']}}">
                    <span class="iconfont icon-service"></span>
                    <span>在线客服</span>
                    </a>
                </div>
            </div>
            <div class="btn-area flex">
                <div class="btn-square">
                    <a href="tel:{{$shop['phone']}}">
                    <span class="iconfont icon-phone"></span>
                    <span>电话客服</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="blank"></div>
        <div class="blank"></div>
    </div>
@stop

@section('foot')
    <div class="fixed-bottom">
        <div class="fixed auction-fixed-bar">
            <div class="total-fee flex">
                <span>实付金额</span>
                <span class="money">￥{{$order['total_fee']}}</span>
            </div>
            <div class="display-flex" style="padding-right: 15px;">
                @if ($order['trade_status'] == 1)
                    <div class="btn-area">
                        <div class="btn-square fontsize-12" rel="cancel">取消订单</div>
                    </div>
                    <div class="btn-area">
                        <div class="btn-square fontsize-12" rel="pay">立即支付</div>
                    </div>
                @endif
                @if ($order['trade_status'] == 2)
                        <div class="btn-area">
                            <div class="btn-square fontsize-12" rel="refund">申请退款</div>
                        </div>
                        <div class="btn-area">
                            <div class="btn-square fontsize-12" rel="notice">提醒卖家发货</div>
                        </div>
                @endif

                @if ($order['trade_status'] == 3)
                        <div class="btn-area">
                            <div class="btn-square fontsize-12" rel="refund">申请退款</div>
                        </div>
                        <div class="btn-area">
                            <div class="btn-square fontsize-12" rel="confirm">确认收货</div>
                        </div>
                @endif

                @if ($order['trade_status'] == 4)
                        @if (!$order['buyer_rate'])
                            <div class="btn-area">
                                <div class="btn-square fontsize-12" rel="evaluate">立即评价</div>
                            </div>
                        @endif
                @endif

                    @if ($order['trade_status'] == 5)
                        <div class="btn-area">
                            <div class="btn-square fontsize-12" rel="refund">查看退款</div>
                        </div>
                    @endif
                @if ($order['buyer_rate'] == 1)
                        <div class="btn-area" data-link="{{url('h5/bought/addreview?order_id='.$order_id)}}">
                            <div class="btn-square fontsize-12">追加评论</div>
                        </div>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var order_id = '{{$order_id}}';
        (function () {
            $("[rel=cancel]").on('click', function () {
                closeOrder(order_id, DSXUtil.reFresh);
            });
            $("[rel=pay]").on('click', function () {
                payOrder(order_id, DSXUtil.reFresh);
            });
            $("[rel=notice]").on('click', function () {
                noticeOrder(order_id);
            });
            $("[rel=refund]").on('click', function () {
                window.location.href = '/h5/bought/refund?order_id='+order_id;
            });
            $("[rel=confirm]").on('click', function () {
                confirmOrder(order_id, DSXUtil.reFresh);
            });
            $("[rel=evaluate]").on('click', function () {
                //evaluteOrder(order_id, DSXUtil.reFresh);
                window.location.href = '/h5/bought/evaluate?order_id='+order_id;
            });
        })();
    </script>
@stop
