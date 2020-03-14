@extends('layouts.seller')

@section('title', '店铺设置')

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">卖家中心</li>
        <li class="breadcrumb-item">我的店铺</li>
        <li class="breadcrumb-item active">店铺未审核</li>
    </ul>
    <div class="content-div">
        <div style="padding: 50px 0; font-size: 16px; text-align: center;">
            你的店铺尚未通过认证, <a href="{{url('seller/shop/auth')}}">立即申请认证</a>
        </div>
    </div>
@stop
