<template>
    <div class="container">
        <template v-if="order">
            <order-view :order="order"></order-view>
        </template>
        <div class="auction" v-else>
            <div class="cell-arrow-right" @click="showPopup=true">
                <div class="address" v-if="address">
                    <div class="icon-wrapper">
                        <i class="iconfont icon-location"></i>
                    </div>
                   <div class="flex">
                       <div>
                           <span>{{address.name}}</span>
                           <span>{{address.tel}}</span>
                       </div>
                       <p>{{address.full_address}}</p>
                   </div>
                </div>
                <div class="address" v-else>
                    <div class="btn-add-addr">
                        <span class="iconfont icon-add"></span>
                        <span>添加收货地址</span>
                    </div>
                </div>
            </div>
            <div class="h10"></div>
            <div class="buynow-goods-info">
                <div class="title">商品信息</div>
                <div class="goods-item">
                    <div class="bg-cover image" :style="'background-image: url('+item.thumb+')'"></div>
                    <div class="data">
                        <div class="goods-title">{{item.title}}</div>
                        <div class="goods-sku" v-if="sku">{{sku.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="goods-price">￥{{item.price}}</div>
                            <div>
                                <van-stepper
                                        :default-value="quantity"
                                        v-model="quantity"
                                        :max="sku ? sku.stock : item.stock"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">配送方式</div>
                    <div class="cell-value">快递</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title">留言</div>
                    <div class="cell-value flex">
                        <input type="text" class="message" placeholder="建议留言前先与商家沟通确认" v-model="remark">
                    </div>
                </div>
            </div>
            <div class="h10"></div>
            <div class="settlement-info">
                <div class="buynow-cell">
                    <div class="cell-title flex">商品金额</div>
                    <div class="cell-value">￥{{goodsFee}}</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">运费</div>
                    <div class="cell-value amount">￥0.00</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">合计</div>
                    <div class="cell-value amount">￥{{goodsFee}}</div>
                </div>
            </div>
            <van-submit-bar
                    :price="goodsFee*100"
                    button-text="提交订单"
                    @submit="onSubmit"
            />
            <van-popup v-model="showPopup" position="bottom">
                <address-view @select="handleSelectedAddress"></address-view>
            </van-popup>
        </div>
    </div>
</template>

<script>
    import AddressView from '../user/Address';
    import OrderView from "../components/OrderView";


    export default {
        name: "BuyNow",
        components: {
            AddressView,
            OrderView
        },
        props: {
            item: {},
            quantity:1,
            sku:null
        },
        data: function () {
            return {
                address: {},
                order: null,
                remark: null,
                showPopup: false,
            }
        },
        mounted() {
            this.getAddress();
        },
        methods: {
            handleShowAddress: function () {
                this.showAddress = true;
            },
            handleSelectedAddress: function (address) {
                this.address = address;
                this.showAddress = false;
            },
            onSubmit: function () {
                if (!this.address) {
                    this.$toast.fail('请选择收货地址');
                    return false;
                }

                this.$axios.post('/webapi/order/create', {
                    itemid: this.item.itemid,
                    quantity: this.quantity,
                    address_id: this.address.address_id,
                    remark: this.remark,
                    sku_id: this.sku ? this.sku.id : 0
                }).then(response => {
                    console.log(response.data);
                    const order = response.data.order;
                    this.$axios.get('/webapi/wechatpay/getconfig?transaction_id=' + order.transaction_id).then(res => {
                        //console.log(response.data);
                        var config = res.data.config;
                        config.timestamp = config.timeStamp;
                        config.success = (res) => {
                            this.$toast.success('付款成功');
                            this.order = order;
                        };
                        config.fail = () => {
                            this.order = order;
                        };
                        config.cancel = () => {
                            this.order = order;
                        };
                        wx.chooseWXPay(config);
                    });
                });
            },
            getAddress: function () {
                this.$axios.get('/webapi/address/get').then(response => {
                    this.address = response.data.address;
                });
            }
        },
        computed: {
            goodsFee: function () {
                return (this.item.price * this.quantity).toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
