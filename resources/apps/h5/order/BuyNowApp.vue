<template>
    <div class="container">
        <div class="auction">
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
                    <div class="bg-cover image" :style="'background-image: url('+product.thumb+')'"></div>
                    <div class="data">
                        <div class="goods-title">{{product.title}}</div>
                        <div class="goods-sku" v-if="sku">{{sku.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="goods-price">￥{{sku.price}}</div>
                            <div>
                                <van-stepper
                                        :default-value="quantity"
                                        v-model="quantity"
                                        :max="sku ? sku.stock : product.stock"
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
                    <div class="cell-title flex">商品总价</div>
                    <div class="cell-value">￥{{orderFee}}</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">运费</div>
                    <div class="cell-value">+￥0.00</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">优惠</div>
                    <div class="cell-value">-￥0.00</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">实付金额</div>
                    <div class="cell-value amount">￥{{orderFee}}</div>
                </div>
            </div>
            <van-submit-bar
                    :price="orderFee*100"
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
    import AddressView from '../user/address/AddressView';
    import OrderProcessor from "../lib/OrderProcessor";

    export default {
        name: "BuyNow",
        components: {
            AddressView
        },
        props: {},
        data() {
            return {
                ...pageConfig,
                order: null,
                remark: null,
                showPopup: false,
                address: null
            }
        },
        mounted() {
            this.getAddress();
        },
        methods: {
            handleSelectedAddress(address) {
                this.address = address;
                this.showPopup = false;
            },
            onSubmit() {
                if (!this.address) {
                    this.$toast.fail('请选择收货地址');
                    return false;
                }

                this.$post('/order/create', {
                    itemid: this.product.itemid,
                    quantity: this.quantity,
                    address: this.address,
                    remark: this.remark,
                    sku_id: this.sku ? this.sku.sku_id : 0
                }).then(response => {
                    //console.log(response.data);
                    this.order = response.data.order;
                    const {order_id} = this.order;
                    OrderProcessor.pay(order_id).then(() => {
                        window.location.replace('/h5/user/#/order/detail?order_id=' + order_id);
                    }).catch(reason => {
                        let message = reason.data ? reason.data.errmsg : reason.errMsg;
                        this.$toast.fail({
                            message,
                            onClose: () => {
                                window.location.replace('/h5/user/#/order/detail?order_id=' + order_id);
                            }
                        })
                    });
                });
            },
            getAddress() {
                this.$get('/address/get').then(response => {
                    this.address = response.data.address;
                });
            }
        },
        computed: {
            orderFee() {
                return (this.sku.price * this.quantity).toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
