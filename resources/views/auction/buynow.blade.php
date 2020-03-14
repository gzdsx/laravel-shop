@extends('layouts.auction')

@section('title', '确认订单')

@section('content')
    <div style="height: 30px; clear: both; display: block;"></div>
    <div class="area">
        <div class="order-address-wrap">
            <h3 class="confirm-address">
                <a class="manage-address" href="{{url('/user/address')}}" target="_blank">管理收货地址</a>
                <span>确认收货地址</span>
            </h3>
            <ul class="address-list" id="address-list">
                <li v-for="address in addresses">
                    <a class="edit-address" @click="editAddress(address)">修改本地址</a>
                    <input title="" type="radio" name="chooseaddress" :value="address.address_id" v-model="address_id">
                    <span>@{{ address.province }} @{{ address.city }} @{{ address.district }} @{{ address.street }}  (@{{ address.consignee }} 收) @{{ address.phone }}</span>
                </li>
            </ul>
            <div class="use-new-address">
                <a class="button" @click="addAddress()">+使用新地址</a>
            </div>
        </div>
    </div>
    <div class="blank"></div>
    <div class="area">
        <form method="post" id="FrmOrder" autocomplete="off" action="{{url('auction/createorder')}}">
            {{csrf_field()}}
            <input type="hidden" name="itemid" value="{{$itemid}}">
            <input type="hidden" name="address_id" :value="address_id">
            <h3>确认订单信息</h3>
            <table cellspacing="1" cellpadding="0" width="100%" class="order-th-table">
                <tr>
                    <th>店铺宝贝</th>
                    <th width="125">单价</th>
                    <th width="125">数量</th>
                    <th width="125">小计</th>
                </tr>
            </table>
            <div class="order-item-wrap">
                <div class="order-item" data-shop-id="{{$shop['shop_id']}}">
                    <table cellpadding="0" cellspacing="0" width="100%" class="order-item-table">
                        <thead>
                        <tr>
                            <th colspan="4">店铺: {{$shop['shop_name']}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="info-img">
                                    <img src="{{image_url($item['thumb'])}}">
                                </div>
                                <div class="info-detail">
                                    <div class="item-name">{{$item['title']}}</div>
                                    <div class="item-attr">颜色:默认 品质:优</div>
                                </div>
                            </td>
                            <td width="125" class="cell-price">{{$item['price']}}</td>
                            <td width="125" class="cell-num">
                                <div class="quantity-inner">
                                    <span class="act" id="decrease" @click="decrease()">-</span>
                                    <input title="" type="text" class="text" name="quantity" value="{{$quantity}}" v-model="quantity">
                                    <span class="act" id="increase" @click="increase()">+</span>
                                </div>
                            </td>
                            <td width="125" class="cell-simple-price">￥{{$item['price']}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="order-ext-wrap">
                        <div class="order-ext">
                            <div class="shop-total">合计: <span class="total-fee" id="total-fee">@{{ totalFee }}</span>元</div>
                            <div class="ext-name">给掌柜留言:</div>
                            <div class="ext-info"><textarea class="form-control w500" placeholder="选填:对本次交易的说明" name="buyer_message"></textarea></div>
                        </div>
                    </div>
                </div>
                <div class="order-ext-wrap">
                    <div class="order-ext">
                        <div class="ext-name">运送方式:</div>
                        <div class="ext-info">
                            <label><input type="radio" name="shipping_type" value="1"@if($shipping_type==1) checked="checked"@endif> 快递</label>
                            <label><input type="radio" name="shipping_type" value="2"@if($shipping_type==2) checked="checked"@endif> 物流配送</label>
                            <label><input type="radio" name="shipping_type" value="3"@if($shipping_type==3) checked="checked"@endif> 上门自取</label>
                        </div>
                    </div>
                    <div class="order-ext">
                        <div class="ext-name">付款方式:</div>
                        <div class="ext-info">
                            <label><input type="radio" name="pay_type" value="1"@if($pay_type==1) checked="checked"@endif> 在线支付</label>
                            <label><input type="radio" name="pay_type" value="2"@if($pay_type==2) checked="checked"@endif> 货到付款</label>
                        </div>
                    </div>
                </div>
                <div class="submit-order">
                    <button type="button" class="btn btn-submit btn-lg" @click="submit()">提交订单</button>
                </div>
            </div>
        </form>
    </div>

    <div style="height: 80px; clear: both; display: block;"></div>
@stop

@section('foot')
    <script>var price=parseFloat('{{$item['price']}}'); var stock=parseInt('{{$item['stock']}}')</script>
    <script type="text/javascript">
        var app, dlg;
        window.afterSaveAddress = function(data) {
            dlg.close();
            app.loadAddress();
        };

        function showAddressForm(address_id) {
            var url = '{{url('user/address/frame')}}';
            if (address_id) url+= '?address_id='+address_id;
            dlg = DSXUI.dialog({
                title: address_id ? '编辑收货地址' : '添加收货地址',
                content:'<iframe scrolling="no" frameborder="0" style="width: 100%; height: 400px;" src="'+url+'"></iframe>',
                showFooter:false,
                style:{
                    width:'700px',
                }
            });
        }
        app = new Vue({
            el:'#app',
            data:{
                addresses:[],
                address_id:0,
                quantity:'{{$quantity}}'
            },
            computed:{
                totalFee:function () {
                    return (this.quantity * price).toFixed(2);
                }
            },
            created() {
                this.loadAddress();
            },
            methods:{
                loadAddress:function () {
                    $.ajax({
                        url:'/user/address/getaddresslist',
                        success:function (response) {
                            response.items.map(function (item) {
                                if (item.isdefault) {
                                    app.address_id = item.address_id;
                                }
                            });
                            app.addresses = response.items;
                        }
                    });
                },
                addAddress:function () {
                    showAddressForm();
                },
                editAddress:function (address) {
                    showAddressForm(address.address_id);
                },
                decrease:function () {
                    if (this.quantity > 1)
                    {
                        this.quantity--;
                    }
                },
                increase:function () {
                    if (this.quantity < stock)
                    {
                        this.quantity++;
                    }
                },
                submit:function () {
                    if (!this.address_id)
                    {
                        DSXUI.showToast('请选择收货地址');
                        return false;
                    }

                    $("#FrmOrder").submit();
                }
            }
        });
    </script>
@stop
