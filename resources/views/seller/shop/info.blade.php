@extends('layouts.seller')

@section('title', '店铺设置')

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">卖家中心</li>
        <li class="breadcrumb-item">我的店铺</li>
        <li class="breadcrumb-item active">资料设置</li>
    </ul>
    <div class="content-div">
        <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
            <tbody>
            <tr>
                <td width="80">店铺名称</td>
                <td>{{$shop['shop_name']}}</td>
            </tr>
            <tr>
                <td>客服电话</td>
                <td>{{$shop['phone']}}</td>
            </tr>
            <tr>
                <td>店铺标志</td>
                <td>
                    <img src="{{image_url($shop['logo'])}}" width="100" height="100" id="logo_preview">
                </td>
            </tr>
            <tr>
                <td>店铺简介</td>
                <td>{{$shop['description']}}</td>
            </tr>
            <tr>
                <td>经营地址</td>
                <td>{{$shop['province'].$shop['city'].$shop['district'].$shop['street']}}</td>
            </tr>
            <tr>
                <td>主要货源</td>
                <td>
                    @if ($shop['main_source'] == 1)
                        自己生产
                    @elseif($shop['main_source'] == 2)
                        代工生产
                    @elseif($shop['main_source'] == 3)
                        线下批发
                    @elseif($shop['main_source'] == 4)
                        分销代销
                    @elseif($shop['main_source'] == 5)
                        自由渠道
                    @endif
                </td>
            </tr>
            <tr>
                <td>店铺介绍</td>
                <td>{{$content['content']}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop
