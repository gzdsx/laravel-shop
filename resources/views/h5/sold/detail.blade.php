@extends('layouts.h5')

@section('title', '订单详情')

@section('content')
    <div class="sold-header" id="app">
        <div class="iconfont icon-scan_light" v-on:click="scan()"></div>
        <div class="input flex">
            <input type="text" class="text" placeholder="请输入快递单号" v-model="express_no">
        </div>
        <div class="send" id="send" v-on:click="send()">发货</div>
    </div>
    <div class="sold">
        <div class="sold-title">基础信息</div>
        <div class="sold-info">
            <div class="sold-cell">
                <div class="cell-1">订单编号</div>
                <div class="flex">{{$order['order_no']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">订单状态</div>
                <div class="flex">已发货</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">买家账号</div>
                <div class="flex">{{$order['buyer_name']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">下单时间</div>
                <div class="flex">{{@date('Y-m-d H:i:s', $order['created_at'])}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">配送方式</div>
                <div class="flex">顺丰快递</div>
            </div>
            @if ($order['pay_status'])
                <div class="sold-cell">
                    <div class="cell-1">支付方式</div>
                    <div class="flex">在线支付</div>
                </div>
                <div class="sold-cell">
                    <div class="cell-1">付款时间</div>
                    <div class="flex">{{@date('Y-m-d H:i:s', $order['pay_at'])}}</div>
                </div>
            @endif
            @if ($order['buyer_message'])
                <div class="sold-cell">
                    <div class="cell-1">买家留言</div>
                    <div class="flex">{{$order['buyer_message']}}</div>
                </div>
            @endif
        </div>

        <div class="sold-title">收货人信息</div>
        <div class="sold-info">
            <div class="sold-cell">
                <div class="cell-1">收货人</div>
                <div class="flex">{{$shipping['consignee']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">联系电话</div>
                <div class="flex">{{$shipping['phone']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">收货地址</div>
                <div class="flex">{{$shipping['province'].$shipping['city'].$shipping['district'].$shipping['street']}}</div>
            </div>
        </div>

        <div class="sold-title">商品信息</div>
        @foreach ($items as $item)
            <div class="sold-info">
                <div class="sold-cell">
                    <div class="cell-1">商品名称</div>
                    <div class="flex">{{$item['title']}}</div>
                </div>
                <div class="sold-cell">
                    <div class="cell-1">商品单价</div>
                    <div class="flex">{{$item['price']}}</div>
                </div>
                <div class="sold-cell">
                    <div class="cell-1">购买数量</div>
                    <div class="flex">{{$item['quantity']}}</div>
                </div>
                <div class="sold-cell">
                    <div class="cell-1">合计金额</div>
                    <div class="flex">{{$item['price'].$item['quantity']}}</div>
                </div>
            </div>
        @endforeach

        <div class="sold-title">商费用信息</div>
        <div class="sold-info">
            <div class="sold-cell">
                <div class="cell-1">商品总金额</div>
                <div class="flex">￥{{$order['total_fee']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">配送费用</div>
                <div class="flex">￥{{$order['shipping_fee']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">订单总金额</div>
                <div class="flex">￥{{$order['total_fee']}}</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">使用优惠券</div>
                <div class="flex">￥0.00</div>
            </div>
            <div class="sold-cell">
                <div class="cell-1">应付金额</div>
                <div class="flex">￥{{$order['total_fee']}}</div>
            </div>
            <div class="sold-cell" style="color: #f00;">
                <div class="cell-1">已付金额</div>
                <div class="flex">￥{{$order['total_fee']}}</div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        wx.ready(function () {
            var app = new Vue({
                el:'#app',
                data:{
                    express_no:'',
                    express_name:'顺丰快递'
                },
                methods:{
                    scan:function () {
                        var $this = this;
                        wx.scanQRCode({
                            needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                            success: function (res) {
                                //var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                                $this.express_no = res.resultStr;
                            }
                        });
                    },
                    send:function () {
                        if (!this.express_no)
                        {
                            weui.toast('请填写快递单号');
                            return false;
                        }

                        $.ajax({
                            type:'POST',
                            url:'/h5/sold/send',
                            data:{express_no:this.express_no, express_name:this.express_name},
                            success:function (response) {
                                if (response.errcode)
                                {
                                    weui.toast(response.errmsg);
                                } else {
                                    weui.toast('发货成功', {
                                        callback:function () {
                                            DSXUtil.reFresh();
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
@stop
