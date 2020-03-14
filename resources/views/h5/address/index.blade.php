@extends('layouts.h5')

@section('title', '地址管理')

@section('content')
    <style>html,body{background-color: #FAFAFA;}</style>
    <div class="caitiao"></div>
    <div class="address-list">
        @foreach ($items as $item)
            <div class="address-item">
                <div class="default">
                    @if($item['isdefault'])<div class="text">默认</div>@endif
                </div>
                <div class="info flex">
                    <div class="contact">
                        <h3 class="flex">{{$item['consignee']}}</h3>
                        <h3>{{substr_replace($item['phone'], '****', 3, 4)}}</h3>
                    </div>
                    <div class="detail">{{$item['province'].$item['city'].$item['district'].$item['street']}}</div>
                </div>
                <div class="edit">
                    <div class="edit-btn" rel="edit" onclick="editAddress({{$item['address_id']}})"></div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('foot')
    <div class="fixed-bottom">
        <div class="fixed">
            <div class="btn-block btn-red" onclick="showForm()">+添加收货地址</div>
        </div>
    </div>
    <div class="overlayer-default" style="position: fixed; display: none;" id="formApp">
        <div class="weui-cells__title">
            <span class="float-right" onclick="hideForm()" style="font-size: 24px; line-height: 1;">×</span>
            <span>编辑收货地址</span>
        </div>
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

    <script src="{{asset('js/h5/address.js')}}" type="text/javascript"></script>
@stop
