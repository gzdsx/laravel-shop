@extends('layouts.h5')

@section('title', '我的订单')

@section('content')
    <div class="app" id="app">
        <div class="h5-tabs">
            <div class="tab-item">
                <span class="tab-link" :class="{'active' : !tradeCode}" v-on:click="onClickTab('')">全部</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active' : tradeCode=='waitPay'}" v-on:click="onClickTab('waitPay')">待付款</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active' : tradeCode=='waitSend'}" v-on:click="onClickTab('waitSend')">待发货</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active' : tradeCode=='waitConfirm'}" v-on:click="onClickTab('waitConfirm')">已发货</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active' : tradeCode=='waitRate'}" v-on:click="onClickTab('waitRate')">待评价</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active' : tradeCode=='refunding'}" v-on:click="onClickTab('refunding')">退款中</span>
            </div>
        </div>

        <div class="h5-order-list">
            <div class="order-item" v-for="order in orders">
                <div class="order-hd display-flex">
                    <div class="flex">@{{ order.order_no }}</div>
                    <div class="order-status">@{{ order.tradeStatusText }}</div>
                </div>

                <div class="order-items" v-on:click="showOrder(order)">
                    <div class="list-item" v-for="item in order.items">
                        <div class="image bg-cover" :style="{'background-image':'url('+item.thumb+')'}"></div>
                        <div class="flex">
                            <div class="title">@{{ item.title }}</div>
                            <div class="attr">[商品属性]</div>
                            <div class="display-flex">
                                <div class="money flex">￥@{{ item.price }}</div>
                                <div>x@{{ item.quantity }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-simple">共计@{{ order.quantity }}件商品,总金额 <span class="money">￥@{{ order.total_fee }}</span></div>
                <div class="order-ft">
                    {{--<div class="order-no">订单号:@{{ order.order_no }}</div>--}}
                    <div class="flex"></div>
                    <div class="btn-area" v-if="order.shipping_status">
                        <div class="btn-action" v-on:click="getShipping(order)">查看物流</div>
                    </div>
                    <div class="btn-area" v-if="order.closed">
                        <div class="btn-action" v-on:click="del(order)">删除订单</div>
                    </div>
                    <template v-if="order.trade_status==1">
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="cancel(order)">取消订单</div>
                        </div>
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="pay(order)">去付款</div>
                        </div>
                    </template>
                    <template v-if="order.trade_status==2">
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="refund(order)">申请退款</div>
                        </div>
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="notice(order)">提醒卖家发货</div>
                        </div>
                    </template>
                    <template v-if="order.trade_status==3">
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="refund(order)">申请退款</div>
                        </div>
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="confirm(order)">确认收货</div>
                        </div>
                    </template>
                    <template v-if="order.trade_status==4">
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="showOrder(order)">订单详情</div>
                        </div>
                        <div class="btn-area" v-if="!order.buyer_rate">
                            <div class="btn-action" @click="evalute(order)">评价</div>
                        </div>
                    </template>
                    <template v-if="order.trade_status==5">
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="refund(order)">查看退款</div>
                        </div>
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="showOrder(order)">订单详情</div>
                        </div>
                    </template>
                    <template v-if="order.trade_status==6">
                        <div class="btn-area">
                            <div class="btn-action" v-on:click="showOrder(order)">订单详情</div>
                        </div>
                    </template>
                    <div class="btn-area">
                        <div class="btn-action" v-on:click="addReview(order)" v-if="order.buyer_rate==1">追加评论</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var offset = 0;
        var tradeStatusTexts = @json(trans('mall.buyer_trade_status_items'));
        var app = new Vue({
            el:'#app',
            data:{
                orders:[],
                tradeCode:'{{$tradeCode}}',
            },
            mounted:function () {
                this.loadOrders();
            },
            methods:{
                loadOrders:function(){
                    var $this = this;
                    $.ajax({
                        url:'/h5/bought/getitemlist',
                        data:{offset:offset, count:10, tradeCode:$this.tradeCode},
                        success:function (response) {
                            response.items.forEach(function (item) {
                                item.tradeStatusText = $this.getTradeStatusText(item.trade_status);
                            });
                            $this.orders = response.items;
                        }
                    });
                },
                onClickTab:function (code) {
                    this.tradeCode = code;
                    this.loadOrders();
                },
                showOrder:function (order) {
                    window.location.href = '/h5/bought/detail?order_id='+order.order_id;
                },
                getTradeStatusText:function (tradeStatus) {
                    return tradeStatusTexts[tradeStatus];
                },
                cancel:function (order) {
                    closeOrder(order.order_id, function () {
                        app.loadOrders();
                    });
                },
                notice:function (order) {
                    noticeOrder(order.order_id);
                },
                confirm:function (order) {
                    confirmOrder(order.order_id, function () {
                        app.loadOrders();
                    });
                },
                pay:function (order) {
                    payOrder(order.order_id, function () {
                        app.loadOrders();
                    });
                },
                getShipping:function (order) {
                    showShipping(order.order_id);
                },
                del:function (order) {
                    deleteOrder(order.order_id, function () {
                        app.loadOrders();
                    });
                },
                refund:function (order) {
                    window.location.href = '/h5/bought/refund?order_id='+order.order_id;
                },
                evalute:function (order) {
                    // evaluteOrder(order.order_id, function (stars, message) {
                    //     app.loadOrders();
                    // });
                    window.location.href = '/h5/bought/evaluate?order_id='+order.order_id;
                },
                addReview:function (order) {
                    window.location.href = '/h5/bought/addreview?order_id='+order.order_id;
                }
            }
        });

        onDocumentReachBottom(function () {

        });

        $("body").css({'overflow':'hidden'});
        $("#shipping-dialog").center().on('tap', function (e) {
            //stopDault(e);
            DSXUtil.stopPropagation(e);
        }).on('touchstart', function (e) {
            DSXUtil.stopPropagation(e);
        });
        $(document).on('touchmove', function (e) {
            DSXUtil.stopPropagation(e);
        });
        $(".dsxui-overlayer").on('tap', function () {
            $(this).hide();
            $("#shipping-dialog").hide();
        })
    </script>
@stop
