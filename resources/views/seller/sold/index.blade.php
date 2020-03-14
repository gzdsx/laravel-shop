@extends('layouts.seller')

@section('title', '已卖出的宝贝')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
    <script type="text/javascript">
        var $CONFIG = {
            tab:'{{$tab}}',
            uid:'{{$uid}}',
            username:'{{$username}}'
        }
    </script>
@stop

@section('content')
    <div class="console-title">
        <h2>订单管理</h2>
    </div>
    <div class="content-div">
        <form method="get" id="searchFrom">
            <div class="dsxui-row">
                <div class="dsxui-col w-33">
                    <div class="dsxui-row">
                        <div class="dsxui-col w80">订单编号:</div>
                        <div class="dsxui-col width-auto"><input title="" type="text" class="form-control w200" name="order_no" value="{{$order_no}}"></div>
                    </div>
                </div>
                <div class="dsxui-col w-33">
                    <div class="dsxui-row">
                        <div class="dsxui-col w80">买家昵称:</div>
                        <div class="dsxui-col width-auto"><input title="" type="text" class="form-control w200" name="buyer_name" value="{{$buyer_name}}"></div>
                    </div>
                </div>
                <div class="dsxui-col w-33">
                    <div class="dsxui-row">
                        <div class="dsxui-col w80">支付方式:</div>
                        <div class="dsxui-col width-auto">
                            <select title="" class="custom-select w200" name="pay_type">
                                <option value="0">全部</option>
                                <option value="1"{{$pay_type==1 ? ' selected="selected"' : ''}}>在线支付</option>
                                <option value="2"{{$pay_type==2 ? ' selected="selected"' : ''}}>货到付款</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dsxui-row" style="margin: 10px 0;">
                <div class="dsxui-col w-33">
                    <div class="dsxui-col w80">物流状态:</div>
                    <div class="dsxui-col width-auto">
                        <select title="" class="custom-select w200" name="wuliu_state">
                            <option value="0">全部</option>
                            <option value="1"{{$wuliu_state==1 ? ' selected="selected"' : ''}}>未发货</option>
                            <option value="2"{{$wuliu_state==2 ? ' selected="selected"' : ''}}>已发货</option>
                            <option value="3"{{$wuliu_state==3 ? ' selected="selected"' : ''}}>已收货</option>
                        </select>
                    </div>
                </div>
                <div class="dsxui-col w-33">
                    <div class="dsxui-col w80">宝贝名称:</div>
                    <div class="dsxui-col width-auto"><input title="" type="text" class="form-control w200" name="title" value="{{$title}}"></div>
                </div>
                <div class="dsxui-col w-33">
                    <div class="dsxui-col w80">交易时间:</div>
                    <div class="dsxui-col width-auto">
                        <div class="input-group">
                            <div><input title="" type="text" class="form-control w100" name="time_begin" onclick="WdatePicker()" value="{{$time_begin}}"></div>
                            <div>-</div>
                            <div><input title="" type="text" class="form-control w100" name="time_end" onclick="WdatePicker()" value="{{$time_end}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dsxui-row">
                <div class="dsxui-col">
                    <div class="dsxui-col w80"></div>
                    <div class="dsxui-col width-auto">
                        <button type="submit" class="btn btn-primary" id="btn-search">搜索订单</button>
                        <button type="button" class="btn btn-default" onclick="window.open('{{url('seller/sold/export')}}')">批量导出</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="dsxui-tabs-container">
        <div class="dsxui-tabs">
            <div class="tab-item"><a href="{{seller_url('sold?tab=all')}}" class="tab-link{{$tab=='all' ? ' active' : ''}}">全部订单</a></div>
            <div class="tab-item"><a href="{{seller_url('sold?tab=waitPay')}}" class="tab-link{{$tab=='waitPay' ? ' active' : ''}}">等待买家付款</a></div>
            <div class="tab-item"><a href="{{seller_url('sold?tab=waitSend')}}" class="tab-link{{$tab=='waitSend' ? ' active' : ''}}">等待发货</a></div>
            <div class="tab-item"><a href="{{seller_url('sold?tab=send')}}" class="tab-link{{$tab=='send' ? ' active' : ''}}">已发货</a></div>
            <div class="tab-item"><a href="{{seller_url('sold?tab=waitRate')}}" class="tab-link{{$tab=='waitRate' ? ' active' : ''}}">等待买家评价</a></div>
            <div class="tab-item"><a href="{{seller_url('sold?tab=refunding')}}" class="tab-link{{$tab=='refunding' ? ' active' : ''}}">退款中</a></div>
            <div class="tab-item"><a href="{{seller_url('sold?tab=closed')}}" class="tab-link{{$tab=='closed' ? ' active' : ''}}">已关闭的订单</a></div>
        </div>
    </div>
    <div class="content-div">
        <table class="dsxui-listtable" cellpadding="0" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>宝贝</th>
                <th width="100">单价</th>
                <th width="80">数量</th>
                <th width="100">买家</th>
                <th width="100">交易状态</th>
                <th width="100">实收款</th>
                <th width="120">操作</th>
            </tr>
            </thead>
        </table>
        @foreach($orders as $order)
        <div class="order-item">
            <table class="dsxui-listtable" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th>
                        <span style="margin-right: 10px;"><input title="" type="checkbox"></span>
                        <span style="margin-right: 10px;">{{$order['created_at']}}</span>
                        <span>{{$order['order_no']}}</span>
                    </th>
                    <th colspan="3"></th>
                    <th colspan="3"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td class="col1">
                        <div class="float-left">
                            <a href="{{item_url($item['itemid'])}}" target="_blank">
                                <img src="{{$item['thumb']}}" width="80" height="80">
                            </a>
                        </div>
                        <div style="margin-left: 90px; overflow: hidden;">
                            <div class="goods-name"><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></div>
                            <div class="goods-attr">商品属性</div>
                        </div>
                    </td>
                    <td width="100">
                        @if ($item['promotion_price'])
                            <p><s>￥{{$item['price']}}</s></p>
                            <p>￥{{$item['promotion_price']}}</p>
                        @else
                            <p>￥{{$item['price']}}</p>
                        @endif
                    </td>
                    <td width="80">{{$item['quantity']}}</td>
                    <td width="100">
                        @if($loop->first){{$order['buyer_name']}}@endif
                    </td>
                    <td width="100">
                        @if ($loop->first)
                            <p>{{$order['sold_order_state_des']}}</p>
                            @if ($order['order_state'] == 1)
                                <p><a rel="edit-price" class="link" data-id="{{$order['order_id']}}">修改价格</a></p>
                            @endif
                            @if ($order['shipping_state'])
                                <p>查看物流</p>
                            @endif
                            @if ($order['receive_state'])
                                <p>货物已签收</p>
                            @endif
                            <p><a href="{{url('trade/sold/detail?order_id='.$order['order_id'])}}" class="link" target="_blank">订单详情</a></p>
                        @endif
                    </td>
                    <td width="100">
                        @if ($loop->first)
                            <p><strong style="color: #FF0000;">￥{{$order['total_fee']}}</strong></p>
                            <p class="font-10">(含运费:￥{{$order['shipping_fee']}})</p>
                        @endif
                    </td>
                    <td width="120">
                        @if ($loop->first)
                            @if($order['order_state'] == 2)
                                <p>
                                    <a href="{{url('trade/sold/detail?order_id='.$order['order_id'])}}" target="_blank">
                                        <span class="btn btn-primary btn-sm">发货</span>
                                    </a>
                                </p>
                            @endif
                            @if($order['order_state'] == 5)
                                <p>
                                    <a href="{{url('trade/sold/refund?order_id='.$order['order_id'])}}" target="_blank">
                                        <span class="btn btn-primary">处理退款</span>
                                    </a>
                                </p>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        <div class="bottom-actions">
            <div class="float-right">{!! $pagination !!}</div>
            <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
        </div>
    </div>
@stop
