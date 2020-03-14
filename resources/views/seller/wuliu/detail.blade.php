@extends('layouts.seller')

@section('title', '物流信息')

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">卖家中心</li>
        <li class="breadcrumb-item active">物流信息</li>
    </ul>
    <div class="content-div">
        <table class="formtable" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td width="70">快递名称:</td>
                <td>{{$order->shipping->express->name}}</td>
            </tr>
            <tr>
                <td width="70">物流单号:</td>
                <td>{{$order->shipping->express_no}}</td>
            </tr>
            <tr>
                <td>物流信息:</td>
                <td>
                    @if ($traces)
                        @foreach ($traces as $trace)
                            <p>
                                <span style="margin-right: 20px;">{{$trace['AcceptTime']}}</span>
                                <span>{{$trace['AcceptStation']}}</span>
                            </p>
                        @endforeach
                    @else
                        <p>暂无物流信息</p>
                    @endif
                </td>
            </tr>
        </table>
    </div>
@stop
