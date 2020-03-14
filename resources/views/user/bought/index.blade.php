@extends('layouts.user')

@section('title', '已买到的宝贝')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
    <script type="text/javascript">
        var $CONFIG = {
            tab: '{{$tab}}',
            uid: '{{$uid}}',
            username: '{{$username}}'
        }
    </script>
@stop

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">我是买家</li>
        <li class="breadcrumb-item active">已买到的宝贝</li>
    </ul>
    <div class="search-container">
        <form method="get" id="searchForm">
            <div class="row">
                <div class="cell">
                    <label>订单编号:</label>
                    <div class="field"><input title="" type="text" class="form-control w200" name="order_no"
                                              value="{{$order_no}}"></div>
                </div>
                <div class="cell">
                    <label>买家昵称:</label>
                    <div class="field"><input title="" type="text" class="form-control w200" name="shop_name"
                                              value="{{$shop_name}}"></div>
                </div>
                <div class="cell">
                    <label>支付方式:</label>
                    <div class="field">
                        <select title="" class="custom-select w200" name="pay_type">
                            <option value="0">全部</option>
                            <option value="1"{{$pay_type==1 ? ' selected="selected"' : ''}}>在线支付</option>
                            <option value="2"{{$pay_type==2 ? ' selected="selected"' : ''}}>货到付款</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label>宝贝名称:</label>
                    <div class="field"><input title="" type="text" class="form-control w200" name="title"
                                              value="{{$title}}"></div>
                </div>
                <div class="cell" style="width: auto;">
                    <label>交易时间:</label>
                    <div class="field">
                        <div class="con"><input title="" type="text" class="form-control w100" name="time_begin"
                                                onclick="WdatePicker()" value="{{$time_begin}}"></div>
                        <div class="con">-</div>
                        <div class="con"><input title="" type="text" class="form-control w100" name="time_end"
                                                onclick="WdatePicker()" value="{{$time_end}}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label>&nbsp;</label>
                    <div class="field">
                        <button type="submit" class="btn btn-primary w100" id="btn-search">搜索订单</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="dsxui-tabs-container">
        <ul class="dsxui-tabs">
            <li class="tab-item"><a href="{{url('user/bought?tab=all')}}"
                                    class="tab-link{{$tab=='all' ? ' active' : ''}}">全部订单</a></li>
            <li class="tab-item"><a href="{{url('user/bought?tab=waitPay')}}"
                                    class="tab-link{{$tab=='waitPay' ? ' active' : ''}}">待付款</a></li>
            <li class="tab-item"><a href="{{url('user/bought?tab=waitSend')}}"
                                    class="tab-link{{$tab=='waitSend' ? ' active' : ''}}">待发货</a></li>
            <li class="tab-item"><a href="{{url('user/bought?tab=waitConfirm')}}"
                                    class="tab-link{{$tab=='waitConfirm' ? ' active' : ''}}">待收货</a></li>
            <li class="tab-item"><a href="{{url('user/bought?tab=waitRate')}}"
                                    class="tab-link{{$tab=='waitRate' ? ' active' : ''}}">待评价</a></li>
            <li class="tab-item"><a href="{{url('user/bought?tab=refunding')}}"
                                    class="tab-link{{$tab=='refunding' ? ' active' : ''}}">退款中</a></li>
            <li class="tab-item"><a href="{{url('user/bought?tab=closed')}}"
                                    class="tab-link{{$tab=='closed' ? ' active' : ''}}">已关闭的订单</a></li>
        </ul>
    </div>

    <div class="content-div">
        <table class="order-title-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td>宝贝</td>
                <td width="80">单价</td>
                <td width="60">数量</td>
                <td width="100">商品操作</td>
                <td width="100">实付款</td>
                <td width="100">交易状态</td>
                <td width="100">交易操作</td>
            </tr>
            </tbody>
        </table>
        @foreach ($orders as $order)
            <div class="order-item-wrap" id="order-item-{{$order['order_id']}}">
                <table class="order-item-table" cellspacing="0" cellpadding="0" width="100%">
                    <thead>
                    <tr>
                        <th>
                            <span class="wrap-checkbox"><input title="" type="checkbox"></span>
                            <span class="wrap-time">{{$order['created_at']}}</span>
                            <span class="wrap-order-no">{{$order['order_no']}}</span>
                        </th>
                        <th colspan="3">
                            <h3>
                                <a href="{{shop_url($order['shop_id'])}}" title="{{$order['shop_name']}}"
                                   target="_blank">
                                    {{mbsubstr($order['shop_name'], 16)}}
                                </a>
                            </h3>
                        </th>
                        <th></th>
                        <th colspan="2" class="text-right">
                            <a class="iconfont icon-deletefill delete-order" title="删除订单" rel="delete"
                               data-id="{{$order['order_id']}}"></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td class="col1">
                                <div class="goods-pic">
                                    <a href="{{item_url($item['itemid'])}}" target="_blank"><img
                                                src="{{$item['thumb']}}"></a>
                                </div>
                                <div style="margin-left: 90px; overflow: hidden;">
                                    <div class="goods-name">
                                        <a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a>
                                    </div>
                                    <div class="goods-attr">产品属性</div>
                                </div>
                            </td>
                            <td class="col2">
                                <p>￥{{$item['price']}}</p>
                            </td>
                            <td class="col3">{{$item['quantity']}}</td>
                            <td class="col4">
                                @if($loop->first)
                                    @if ($order['pay_state'] && !$order['receive_state'])
                                        <p><a href="{{url('trade/bought/refund?order_id='.$order['order_id'])}}"
                                              target="_blank">退款/退货</a></p>
                                    @endif

                                    @if ($order['receiver_state'])
                                        <p><a>申请售后</a></p>
                                    @endif
                                    @if ($order['pay_state'])
                                        <p><a>投诉卖家</a></p>
                                    @endif
                                @endif
                            </td>
                            <td class="col5">
                                @if($loop->first)
                                    <p><strong style="color: #FF0000;">￥{{$order['total_fee']}}</strong></p>
                                    <p style="font-size: 11px;">(含运费:￥{{$order['shipping_fee']}})</p>
                                @endif
                            </td>
                            <td class="col6">
                                @if ($loop->first)
                                    <p>{{$order['bought_order_state_des']}}</p>
                                    <p><a href="{{url('trade/bought/detail?order_id='.$order['order_id'])}}"
                                          target="_blank">订单详情</a></p>
                                @endif
                            </td>
                            <td class="col7">
                                @if ($loop->first)
                                    @if ($order['order_state']==1)
                                        <a href="{{url('auction/pay?order_id='.$order['order_id'])}}" target="_blank"
                                           role="button">
                                            <span class="btn btn-primary btn-sm">立即支付</span>
                                        </a>
                                        <p style="margin: 3px 0;"><a href="{{url('trade/bought/close?order_id='.$order['order_id'])}}" target="_blank">取消订单</a></p>
                                    @endif
                                    @if($order['order_state']==2)
                                        <a>提醒卖家发货</a>
                                    @endif
                                    @if($order['order_state']==3)
                                        <a href="{{url('trade/bought/detail?order_id='.$order['order_id'])}}"
                                           target="_blank" role="button">
                                            <span class="btn btn-primary btn-sm">确认收货</span>
                                        </a>
                                    @endif
                                    @if($order['order_state']==4)
                                        <p><a>立即评价</a></p>
                                    @endif
                                    @if($order['order_state']==5)
                                        <p><a>申请退货</a></p>
                                    @endif
                                    @if($order['order_state']==6)
                                        <p><a>再次购买</a></p>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
    <div class="pagination-container">{!! $pagination !!}</div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("a[rel=delete]").on('click', function () {
                var order_id = $(this).attr('data-id');
                DSXUI.showConfirm('确认要删除此订单吗?', function () {
                    $.ajax({
                        type:'POST',
                        url: "{{url('trade/bought/delete')}}",
                        data: {order_id: order_id},
                        success: function (response) {
                            if (response.errcode) {
                                DSXUI.error('系统繁忙,请稍后再试');
                            } else {
                                DSXUI.showToast('订单已删除');
                                $("#order-item-" + order_id).remove();
                            }
                        }
                    });
                });
            });
        });
    </script>
@stop
