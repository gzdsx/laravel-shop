@extends('layouts.admin')

@section('title', '订单详情')

@section('content')
    <style type="text/css">
        /*===订单列表===*/
        .order-title-table{background-color: #F2F2F2; font-size: 13px; border: 1px #e5e5e5 solid; clear: both;}
        .order-title-table td{padding: 10px 0; text-align: center; color: #777;}

        .order-item-wrap{display: block; margin-top: 10px;}
        .order-item-table{border: 1px #e5e5e5 solid;}
        .order-item-table:hover{border-color: #999;}
        .order-item-table thead th{background-color: #F2F2F2; padding: 10px 15px; font-weight: normal; text-align: left; font-size: 12px; color: #666; border-bottom: 1px #e5e5e5 solid;}
        .order-item-table thead .wrap-checkbox{margin-right: 3px;}
        .order-item-table thead .wrap-time{font-weight: bold; margin-right: 5px; color: #222;}
        .order-item-table thead .wrap-order-no{color: #666;}
        .order-item-table thead h3{font-size: 12px; color: #222;}
        .order-item-table thead .delete-order{color: #888;}
        .order-item-table thead .delete-order:hover{color: #222;}
        .order-item-table tbody td{padding: 15px 0; font-size: 12px; color: #666; font-weight: 400;}
        .order-item-table tbody .goods-pic{width: 80px; float: left;}
        .order-item-table tbody .goods-pic img{width: 80px; height: 80px; display: block;}
        .order-item-table tbody .goods-name{line-height: 1; font-size: 12px; padding: 8px 0; height: auto; color: #333;}
        .order-item-table tbody .goods-attr{font-size: 13px; color: #999; line-height: 1;}
        .order-item-table tbody .col1{padding: 15px; text-align: left;}
        .order-item-table tbody .col2{width: 100px; vertical-align: top; text-align: center; font-size: 12px;}
        .order-item-table tbody .col3{width: 80px; vertical-align: top; text-align: center; font-size: 14px;}
        .order-item-table tbody .col4{width: 100px; vertical-align: top; text-align: center;}
        .order-item-table tbody .col5,.order-item-table tbody .col6,.order-item-table tbody .col7{
            border-left: #e5e5e5 solid 1px; vertical-align: top; width: 120px; text-align: center;
        }
        .order-item-table tbody .col7 .btn{
            height: 26px; line-height: 26px; border-radius: 3px;
        }
        .order-item-table tbody td p{display: block; padding-bottom: 3px;}

        .order-container{
            width: 950px; display: block; margin: 0 auto;
        }
        .order-container h1.title{font-size: 16px; padding: 15px 0; display: block; text-align: center;}
        .order-container .h3-title{font-size: 14px; padding: 15px 0; display: block;}
        .order-container .address-row{
            height: 30px; line-height: 30px; font-size: 12px;
        }
        .order-container .address-row label{font-weight: 700; width: 80px; display: inline-block;}
        .order-container .address-row .content{display: inline-block; vertical-align: middle;}
        .order-container .detail-table{clear: both;}
        .order-container .detail-table td{width: 33.333%; padding: 10px 0; font-size: 12px;}
        .order-container .detail-table td label{width: 70px; text-align: right; display: inline-block;}
        .order-container .detail-table td .content{display: inline-block; vertical-align: middle;}
    </style>
    <div class="order-container">
        <h1 class="title">订单详情</h1>
        <h3 class="h3-title">买家信息</h3>
        <div class="address-row">
            <label>买家账号:</label>
            <div class="content">{{$order['buyer_name']}}</div>
        </div>
        <div class="address-row">
            <label>付款方式:</label>
            <div class="content">{{$order['pay_type_des']}}</div>
        </div>
        <div class="address-row">
            <label>收货人:</label>
            <div class="content">{{$order->shipping['name']}}</div>
        </div>
        <div class="address-row">
            <label>联系电话:</label>
            <div class="content">{{$order->shipping['tel']}}</div>
        </div>
        <div class="address-row">
            <label>收货地址:</label>
            <div class="content">{{$order->shipping['province']}}{{$order->shipping['city']}}{{$order->shipping['district']}}{{$order->shipping['street']}}</div>
        </div>
        <h3 class="h3-title">订单信息</h3>
        <table cellspacing="0" cellpadding="0" width="100%" class="detail-table">
            <tr>
                <td>
                    <label>订单编号:</label>
                    <div class="content">{{$order['order_no']}}</div>
                </td>
                <td>
                    <label>创建时间:</label>
                    <div class="content">{{$order['created_at']}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>付款时间:</label>
                    <div class="content">{{$order['pay_at']}}</div>
                </td>
                <td>
                    <label>发货时间:</label>
                    <div class="content">{{$order['shipping_at']}}</div>
                </td>
            </tr>
        </table>
        <h3 class="h3-title">商品信息</h3>
        <table class="order-title-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td>宝贝</td>
                <td width="100">单价</td>
                <td width="80">数量</td>
                <td width="120">实付款</td>
            </tr>
            </tbody>
        </table>
        <div class="order-item-wrap">
            <table class="order-item-table" cellspacing="0" cellpadding="0" width="100%">
                <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td class="col1">
                        <div class="goods-pic">
                            <img src="{{$item['thumb']}}">
                        </div>
                        <div style="margin-left: 90px; overflow: hidden;">
                            <div class="goods-name">{{$item['title']}}</div>
                            <div class="goods-attr">商品属性</div>
                        </div>
                    </td>
                    <td class="col2">
                        @if($item['market_price'])<p><s>￥{{$item['market_price']}}</s></p>@endif
                        <p>￥{{$item['price']}}</p>
                    </td>
                    <td class="col3">x{{$item['quantity']}}</td>
                    <td class="col5">
                        @if($loop->index==0)
                        <p><strong style="color: #FF0000;">￥{{$order['total_fee']}}</strong></p>
                        <p style="font-size: 11px;">(含运费:￥{{$order['shipping_fee']}})</p>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center; display: block; margin-top: 40px; font-size: 14px;"><a href="javascript:window.print();">打印订单</a></div>
    </div>
    <div style="clear: both; height: 50px;"></div>
@stop
