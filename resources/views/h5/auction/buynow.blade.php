@extends('layouts.h5')

@section('title', '确认订单')

@section('content')
<div class="auction" id="app">
    <form method="post" action="{{url('h5/auction/createorder')}}" id="orderFrm">
        @csrf
        <input type="hidden" name="itemid" value="{{$itemid}}">
        <input type="hidden" name="pay_type" value="1">
        <input type="hidden" name="shipping_type" value="1">
        <input type="hidden" name="address_id" :value="address_id">
        <div class="shipping" v-if="shipping" v-on:click="chooseAddress()">
            <div class="ico"><span class="iconfont icon-location"></span></div>
            <div class="flex">
                <div class="display-flex">
                    <div class="flex">@{{ shipping.consignee }}</div>
                    <div>@{{ shipping.phone }}</div>
                </div>
                <div class="address">@{{ shipping.province }}@{{ shipping.city }}@{{ shipping.district }}@{{ shipping.street }}</div>
            </div>
        </div>
        <div class="caitiao"></div>
        <div class="blank"></div>
        <div class="items">
            <div class="list-item">
                <div class="image bg-cover" style="background-image: url({{image_url($item['thumb'])}})"></div>
                <div class="content">
                    <div class="title">{{$item['title']}}</div>
                    <div class="subtitle">{{$item['title']}}</div>
                    <div class="flex"></div>
                    <div class="display-flex">
                        <div class="price">￥{{$item['price']}}</div>
                        <div class="quantity">x@{{ quantity }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cells margin-top-0">
            <div class="weui-cell">
                <div class="weui-cell__bd">购买数量</div>
                <div class="weui-cell__ft">
                    <div class="quantity-control">
                        <div class="ac" v-on:click="decrease()">-</div>
                        <div><input type="text" name="quantity" class="textfield" :value="quantity" title=""></div>
                        <div class="ac" v-on:click="increase()">+</div>
                    </div>
                </div>
            </div>
            <div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">配送方式</div>
                <div class="weui-cell__ft">快递 免邮</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea name="buyer_message" class="weui-textarea" rows="3" placeholder="买家留言： 选填，填写内容已和卖家协商确认"></textarea>
                </div>
            </div>
        </div>
    </form>

    <div class="overlayer-default" v-if="showAddrForm">
        <div class="weui-cells__title">请填写收货地址</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" :value="formattedArea" placeholder="省份、城市、区县" readonly v-on:click="pickDistrict()"/>
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
            <div class="weui-btn weui-btn_primary" v-on:click="saveAddress()">提交</div>
        </div>
        <div class="weui-btn-area" v-if="shipping">
            <div class="weui-btn weui-btn_default" v-on:click="showAddrForm=false">取消</div>
        </div>
    </div>

    <div class="overlayer-default" v-show="showChoose">
        <div class="hd">
            <div class="weui-cells__title">选择收货地址</div>
            <div class="weui-cells">
                <div class="weui-cell" v-for="addr in addresses">
                    <div class="weui-cell__bd" v-on:click="onPickAddress(addr)">
                        <div class="display-flex">
                            <div class="flex">@{{ addr.consignee }}</div>
                            <div class="">@{{ addr.phone }}</div>
                        </div>
                        <p class="fontsize-14">@{{ addr.province }}@{{ addr.city }}@{{ addr.district }}@{{ addr.street }}</p>
                    </div>
                </div>
            </div>
            <div style="position: absolute; bottom: 0; left: 0; right: 0;">
                <div style="padding: 10px; display: block; background-color: #fff;">
                    <div class="btn-square btn-square-warn" v-on:click="showForm()">+添加收货地址</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('foot')
    <div class="fixed-bottom">
        <div class="fixed auction-fixed-bar">
            <div class="total-fee flex">
                <span>总计:</span>
                <span class="money" id="totalFee">￥{{formatAmount($total_fee)}}</span>
            </div>
            <div class="settlement-btn" id="submitButton">提交订单</div>
        </div>
    </div>

    <script>var shipping = @json($shipping);</script>
    <script type="text/javascript">
        var price = parseFloat('{{$item['price']}}');
        var app = new Vue({
            el:'#app',
            data:{
                itemid:'{{$itemid}}',
                quantity:parseInt('{{$quantity}}'),
                price:parseFloat('{{$item['price']}}'),
                shipping:shipping,
                formattedArea:'',
                address:{
                    consignee:'',
                    phone:'',
                    province:'',
                    city:'',
                    district:'',
                    street:'',
                    isdefault:true
                },
                address_id:0,
                addresses:[],
                showChoose:false,
                showAddrForm:!shipping
            },
            computed:{

            },
            mounted:function(){
                this.total();
                if (this.shipping)
                {
                    this.address_id = this.shipping.address_id;
                }
            },
            methods:{
                decrease:function () {
                    if (this.quantity > 1) {
                        this.quantity--;
                        this.total();
                    }
                },
                increase:function () {
                    this.quantity++;
                    this.total();
                },
                total:function () {
                    var total = this.price*this.quantity;
                    $("#totalFee").text('￥'+total.toFixed(2).toString());
                },
                saveAddress:function () {
                    var $this = this;
                    var address = this.address;
                    if (!this.address.province || !this.address.city || !this.address.district){
                        weui.topTips('请选择区域');
                        return false;
                    }

                    if (!this.address.street){
                        weui.topTips('请填写街道地址');
                        return false;
                    }

                    if (!this.address.consignee){
                        weui.topTips('请填写姓名');
                        return false;
                    }

                    if (!this.address.phone){
                        weui.topTips('请填写手机号码');
                        return false;
                    }
                    this.address.isdefault = this.address.isdefault ? 1 : 0;
                    $.ajax({
                        type:'POST',
                        url: '/h5/saveaddress',
                        data:{address:address},
                        success:function (response) {
                            $this.shipping = response.address;
                            $this.address_id = $this.shipping.address_id;
                            $this.showAddrForm = false;
                        },
                        complete:function (xhr) {

                        }
                    });
                },
                pickDistrict:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/getdistrictjson',
                        success:function (response) {
                            weui.picker(response, {
                                onConfirm:function (result) {
                                    $this.address.province = result[0].label;
                                    $this.address.city = result[1].label;
                                    $this.address.district = result[2].label;
                                    $this.formattedArea = $this.address.province+'/'+$this.address.city+'/'+$this.address.district;
                                }
                            });
                        }
                    });
                },
                chooseAddress:function () {
                    var $this = this;
                    $this.showChoose = true;
                    $.ajax({
                        url:'/h5/getaddresslist',
                        success:function (response) {
                            $this.addresses = response.items;
                        }
                    });
                },
                onPickAddress:function (addr) {
                    this.shipping = addr;
                    this.address_id = addr.address_id;
                    this.showChoose = false;
                },
                showForm:function () {
                    this.showAddrForm = true;
                    this.showChoose = false;
                }
            }
        });
        $("#submitButton").on('click', function () {
            $("#orderFrm").submit();
        });
    </script>
@stop
