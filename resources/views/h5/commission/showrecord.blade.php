@extends('layouts.h5')

@section('title', '佣金明细')

@section('content')
    <div class="app">
        <div class="commission-record-hd">
            @if ($uper)
                <div class="user-item">
                    <div class="level">上级</div>
                    <div class="avatar"><img src="{{avatar($uper['uid'])}}"></div>
                    <div class="username">{{$uper['username']}}</div>
                    <div class="amount">￥{{$uprecord['amount']}}</div>
                    <div class="subject">{{$uprecord['subject']}}</div>
                </div>
                <div class="seperator"></div>
            @endif
            <div class="user-item">
                <div class="level">我</div>
                <div class="avatar"><img src="{{avatar($uid)}}"></div>
                <div class="username">{{$username}}</div>
                <div class="amount">￥{{$record['amount']}}</div>
                <div class="subject">消费返佣</div>
            </div>
                @if ($suber)
                    <div class="seperator"></div>
                    <div class="user-item">
                        <div class="level">下级</div>
                        <div class="avatar"><img src="{{avatar($suber['uid'])}}"></div>
                        <div class="username">{{$suber['username']}}</div>
                        <div class="amount">￥{{$subrecord['amount']}}</div>
                        <div class="subject">{{$subrecord['subject']}}</div>
                    </div>
                @endif
            <div class="seperator"></div>
            <div class="user-item">
                @if ($suber)
                    <div class="level">下下级</div>
                @else
                    <div class="level">下级</div>
                @endif
                <div class="avatar"><img src="{{avatar($buyer['uid'])}}"></div>
                <div class="username">{{$buyer['username']}}</div>
                <div class="amount current">￥{{$order['total_fee']}}</div>
                <div class="subject current">用户消费</div>
            </div>
        </div>

        <div class="commission-order">
            <div class="order-hd">
                <div class="flex">下级用户消费订单明细</div>
                <div>{{@date('Y.m.d H:i', $order->created_at)}}</div>
            </div>
            <?php $total=0;?>
            @foreach ($order->items as $item)
                <div class="list-item">
                    <div class="image bg-cover" style="background-image: url({{image_url($item['thumb'])}})"></div>
                    <div class="content">
                        <div class="title">{{$item['title']}}</div>
                        <span class="quantity">x{{$item['quantity']}}</span>
                    </div>
                </div>
                <?php $total+=$item->quantity;?>
            @endforeach
            <div class="simple">共计{{$total}}件商品, 合计:{{$order['total_fee']}}</div>
        </div>
    </div>
@stop
