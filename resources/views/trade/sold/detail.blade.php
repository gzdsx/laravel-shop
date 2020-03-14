@extends('layouts.trade')

@section('title', '订单详情')

@section('content')
    <div class="area">
        <ul class="follow-steps">
            <li class="{{$step=='auction' ? 'active' : ''}}"><span>1. 买家拍下</span></li>
            <li class="{{$step=='pay' ? 'active' : ''}}"><span>2. 买家付款</span></li>
            <li class="{{$step=='send' ? 'active' : ''}}"><span>3. 发货</span></li>
            <li class="{{$step=='confirm' ? 'active' : ''}}"><span>4. 确认收货</span></li>
            <li class="{{$step=='rate' ? 'active' : ''}}"><span>5. 双方互评</span></li>
        </ul>
    </div>

    <div class="area">
        <div class="form-div">
            <h3 class="h3-title">订单信息</h3>
            <table cellspacing="0" cellpadding="0" width="100%" class="order-table">
                <tbody>
                <tr>
                    <td width="80">订单编号</td>
                    <td width="400">{{$order['order_no']}}</td>
                    <td width="80">下单时间</td>
                    <td>{{$order['created_at']}}</td>
                </tr>
                <tr>
                    <td>订单金额</td>
                    <td>{{$order['total_fee']}}</td>
                    <td>付款方式</td>
                    <td>{{$order['pay_type_des']}}</td>
                </tr>
                <tr>
                    <td>支付状态</td>
                    <td>{{$order['pay_state'] ? '已支付' : '未支付'}}</td>
                    <td>付款时间</td>
                    <td>{{$order['pay_at']}}</td>
                </tr>
                <tr>
                    <td>交易流水</td>
                    <td>{{$order['transaction']['transaction_no']}}</td>
                    <td>交易状态</td>
                    <td>{{$order['sold_order_state_des']}}</td>
                </tr>
                </tbody>
            </table>
            <h3 class="h3-title">收货人信息</h3>
            <table cellspacing="0" cellpadding="0" width="100%" class="order-table">
                <tbody>
                <tr>
                    <td width="80">收货人</td>
                    <td width="400">{{$order['shipping']['consignee']}}</td>
                    <td width="80">联系电话</td>
                    <td>{{$order['shipping']['phone']}}</td>
                </tr>
                <tr>
                    <td>收货地址</td>
                    <td colspan="3">
                        {{$order['shipping']['province']}}
                        {{$order['shipping']['city']}}
                        {{$order['shipping']['district']}}
                        {{$order['shipping']['street']}}
                    </td>
                </tr>
                <tr>
                    <td>买家留言</td>
                    <td colspan="3">{{$order['buyer_message']}}</td>
                </tr>
                </tbody>
            </table>

            <h3 class="h3-title">商品信息</h3>
            <table class="item-table-header" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td>宝贝</td>
                    <td width="100" class="align-right">单价</td>
                    <td width="80" class="align-right">数量</td>
                    <td width="140" class="align-right">实付款</td>
                </tr>
                </tbody>
            </table>
            <div class="order-item-wrap">
                <table class="item-table-content" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td class="col1">
                                <div class="thumb">
                                    <img src="{{image_url($item['thumb'])}}">
                                </div>
                                <div style="margin-left: 90px; overflow: hidden;">
                                    <div class="title"><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></div>
                                    <div class="attr">商品属性</div>
                                </div>
                            </td>
                            <td class="col2 align-right" width="100">
                                <p>￥{{$item['price']}}</p>
                            </td>
                            <td class="col3 align-right" width="80">x{{$item['quantity']}}</td>
                            <td class="col5 align-right" width="140">
                                <p><strong style="color: #FF0000;">￥{{$order['total_fee']}}</strong></p>
                                <p style="font-size: 11px;">(含运费:￥{{$order['shipping_fee']}})</p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if($order['shipping_state'])
                <h3 class="h3-title">发货信息</h3>
                <table cellspacing="0" cellpadding="0" width="100%" class="order-table">
                    <tbody>
                    @if($order['shipping']['shipping_type'] == 1)
                        <tr>
                            <td width="80">发货方式</td>
                            <td>快递</td>
                        </tr>
                        <tr>
                            <td>快递公司</td>
                            <td>
                                <span style="margin-right: 20px;">{{$order['shipping']['express_name']}}</span>
                                <span><a href="{{seller_url('wuliu/detail?order_id='.$order_id)}}">查看物流</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>快递单号</td>
                            <td>
                                <span>{{$order['shipping']['express_no']}}</span>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td width="80">发货方式</td>
                            <td>虚拟商品，无需物流</td>
                        </tr>
                    @endif
                    <tr>
                        <td>发货时间</td>
                        <td>{{$order['shipping_at']}}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
            @if($order['trade_state'] == 2)
                <h3 class="h3-title">发货</h3>
                <form method="post" id="sendForm" action="{{url('trade/sold/send')}}" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" name="order_id" value="{{$order_id}}">
                    <table cellpadding="0" cellspacing="0" width="100%" class="order-table">
                        <tbody>
                        <tr>
                            <td class="cell-name" width="80">物流类别</td>
                            <td>
                                <label><input type="radio" name="shipping_type" value="1" checked="checked"> <span>快递</span></label>
                                <label><input type="radio" name="shipping_type" value="2"> <span>无需物流</span></label>
                            </td>
                        </tr>
                        </tbody>
                        <tbody id="express_body">
                        <tr>
                            <td class="cell-name">快递公司</td>
                            <td>
                                <select title="" class="form-control custom-select w200" name="express_id">
                                    @foreach($expresses as $express)
                                        <option value="{{$express['id']}}">{{$express['name']}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-name">快递单号</td>
                            <td><input title="" type="text" class="form-control w200" name="express_no" id="express_no"></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="cell-name"></td>
                            <td><input type="submit" class="btn btn-primary w100" value="立即发货"></td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            @endif
        </div>
    </div>

    <div style="clear: both; height: 50px;"></div>
    @if ($order['trade_state'] == 2)
        <script type="text/javascript">
            $(function () {
                $("input[name=shipping_type]").on('click', function (e) {
                    if($(this).val() === '1'){
                        $("#express_body").show();
                    }else {
                        $("#express_body").hide();
                    }
                });
                $("#sendForm").submit(function () {
                    var shpping_type = $("input[name=shipping_type]:checked").val();
                    var express_no = $.trim($("#express_no").val());
                    if (!shpping_type) {
                        DSXUI.error('请选择物流类别');
                        return false;
                    }
                    if (shpping_type == 1 && !express_no){
                        DSXUI.error('请输入快递单号');
                        return false;
                    }
                });
            });
        </script>
    @endif
@stop
