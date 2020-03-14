@extends('layouts.seller')

@section('title', '店铺认证')

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">卖家中心</li>
        <li class="breadcrumb-item">我的店铺</li>
        <li class="breadcrumb-item active">店铺认证</li>
    </ul>
    <div class="content-div shop-auth" id="app">
        <form method="post" id="Form">
            @csrf
            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">店主姓名:</div>
                <div class="label-input">
                    {{$auth['shop_owner']}}
                </div>
            </div>

            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">身份证号:</div>
                <div class="label-input">
                    {{$auth['id_card_no']}}
                </div>
            </div>

            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">身份证照正面:</div>
                <div class="label-input">
                    <img src="{{image_url($auth['id_card_pic_1'])}}" width="200">
                </div>
            </div>

            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">身份证照背面:</div>
                <div class="label-input">
                    <img src="{{image_url($auth['id_card_pic_2'])}}" width="200">
                </div>
            </div>

            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">手持身份证照:</div>
                <div class="label-input">
                    <img src="{{image_url($auth['id_card_pic_3'])}}" width="200">
                </div>
            </div>
            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">营业执照编号:</div>
                <div class="label-input">
                    {{$auth['license_no']}}
                </div>
            </div>
            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">营业执照照片:</div>
                <div class="label-input">
                    <img src="{{image_url($auth['license_pic'])}}" width="200">
                </div>
            </div>
            <div class="form-group">
                <div class="lable-name" style="line-height: 1.5;">其他证件照片:</div>
                <div class="label-input">
                    <img src="{{image_url($auth['other_pic'])}}" width="200">
                </div>
            </div>
        </form>
    </div>
@stop
