@extends('layouts.h5')

@section('title', '填写收货地址')

@section('content')
    <div class="app" id="app">
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" :value="formattedArea" placeholder="省份、城市、区县" readonly id="area"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" v-model="address.street" placeholder="详细地址，如街道，门牌号等"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" v-model="address.consignee" placeholder="姓名"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" v-model="address.phone" placeholder="手机号码"/>
                </div>
            </div>
            <label class="weui-cell weui-cells_checkbox weui-check__label" for="s12">
                <div class="weui-cell__bd">
                    <p>默认地址</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="checkbox" name="checkbox1" v-model="address.isdefault" class="weui-check" id="s12">
                    <i class="weui-icon-checked"></i>
                </div>
            </label>
        </div>

        <div class="weui-btn-area">
            <div class="weui-btn weui-btn_primary" v-on:click="submit()">提交</div>
            <div class="weui-btn weui-btn_default" v-on:click="del(address_id)" v-if="address_id">删除</div>
        </div>
    </div>
@stop
