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
    <div class="blank" style="height: 30px;"></div>
    <div class="area">
        <h3>确认订单信息</h3>
        <table cellspacing="1" cellpadding="0" width="100%" class="order-th-table">
            <tr>
                <th>店铺宝贝</th>
                <th width="125" class="align-right">单价</th>
                <th width="125">数量</th>
                <th width="125" class="align-right">小计</th>
            </tr>
        </table>
        <div class="order-item-wrap">
            <form method="post" id="FrmOrder" action="{{url('auction/settlement')}}">
                {{csrf_field()}}
                <input type="hidden" name="address_id" :value="address_id">
                <div class="order-item" style="margin-bottom: 20px;" v-for="(data,index) in shops" :key="data.shop.shop_id">
                    <table cellpadding="0" cellspacing="0" width="100%" class="order-item-table">
                        <thead>
                        <tr>
                            <th colspan="4">
                                <span class="iconfont icon-shopfill"></span>
                                <span>@{{ data.shop.shop_name }}</span>
                                <input type="hidden" :name="'order_data['+index+'][shop_id]'" :value="data.shop.shop_id">
                                <input type="hidden" :name="'order_data['+index+'][shop_name]'" :value="data.shop.shop_name">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in data.items">
                            <td>
                                <div class="info-img">
                                    <img :src="item.thumb">
                                    <input type="hidden" :name="'order_data['+index+'][items][]'" :value="item.itemid">
                                </div>
                                <div class="info-detail">
                                    <div class="item-name">@{{ item.title }}</div>
                                    <div class="item-attr">颜色:默认 品质:优</div>
                                </div>
                            </td>
                            <td width="125" class="cell-price align-right">@{{ item.price }}</td>
                            <td width="125" class="cell-num">x@{{ item.quantity }}</td>
                            <td width="125" class="cell-simple-total align-right">@{{ item.price*item.quantity }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="order-ext-wrap">
                        <div class="order-ext">
                            <div class="shop-total">
                                <p class="align-right">运费: <span class="total-fee">@{{ data.shippingFee }}</span></p>
                                <p class="align-right">店铺合计: <span class="total-fee">@{{ data.totalFee }}</span></p>
                            </div>
                            <div class="ext-name">给掌柜留言:</div>
                            <div class="ext-info">
                                <textarea class="form-control" :name="'order_data['+index+'][buyer_message]'" placeholder="选填:对本次交易的说明" style="width: 500px; height: 60px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-ext-wrap">
                    <div class="order-ext">
                        <div class="shop-total">合计: <span class="total-fee">@{{ totalFee }}</span></div>
                        <div class="ext-name">运送方式:</div>
                        <div class="ext-info">
                            <label><input type="radio" name="shipping_type" value="1" checked="checked"> 快递</label>
                            <label><input type="radio" name="shipping_type" value="2"> 物流配送</label>
                            <label><input type="radio" name="shipping_type" value="3"> 上门自取</label>
                        </div>
                    </div>
                    <div class="order-ext">
                        <div class="ext-name">付款方式:</div>
                        <div class="ext-info">
                            <label><input type="radio" name="pay_type" value="1" checked="checked"> 在线支付</label>
                            <label><input type="radio" name="pay_type" value="2"> 货到付款</label>
                        </div>
                    </div>
                </div>
                <div class="submit-order">
                    <button type="button" class="btn btn-submit" @click="submit()">提交订单</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script>var shops=@json($shops);</script>
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
                shops:[],
                totalFee:0,
                address_id:0,
                addresses:[],
            },
            computed:{
            },
            created:function () {
                var $this = this;
                shops.forEach(function (shop) {
                    shop.totalFee = 0;
                    shop.shippingFee = 0;
                    shop.items.map(function (item) {
                        shop.totalFee+= parseFloat(item.price) * parseInt(item.quantity);
                        shop.shippingFee+= 0;
                    });
                    $this.totalFee+= shop.totalFee + shop.shippingFee;
                    shop.totalFee = shop.totalFee.toFixed(2);
                    shop.shippingFee = shop.shippingFee.toFixed(2);
                });
                $this.shops = shops;
                $this.totalFee = $this.totalFee.toFixed(2);
                $this.loadAddress();
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
