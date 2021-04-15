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
                <div class="goods-item" v-for="item in items" :key="item.itemid">
                    <div class="bg-cover image" :style="'background-image: url('+item.product.thumb+')'"></div>
                    <div class="data">
                        <div class="goods-title">{{item.product.title}}</div>
                        <div class="goods-sku">{{item.sku.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="goods-price">￥{{item.sku.price}}</div>
                            <div>
                                x{{item.quantity}}
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
                        <input type="text" class="message" v-model="remark" placeholder="建议留言前先与商家沟通确认">
                    </div>
                </div>
            </div>
            <div class="h10"></div>
            <div class="settlement-info">
                <div class="buynow-cell">
                    <div class="cell-title flex">商品总价</div>
                    <div class="cell-value">￥{{product_fee}}</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">运费</div>
                    <div class="cell-value">+￥{{shipping_fee}}</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">优惠</div>
                    <div class="cell-value">-￥{{discount_fee}}</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">实付金额</div>
                    <div class="cell-value amount">￥{{order_fee}}</div>
                </div>
            </div>
            <van-submit-bar
                    :price="order_fee*100"
                    button-text="提交订单"
                    @submit="handleSubmit"
            />
            <van-popup v-model="showPopup" position="bottom">
                <address-view @select="handleSelectedAddress"/>
            </van-popup>
        </div>
    </div>
</template>

<script>
    import AddressView from '../user/address/AddressView';
    import OrderProcessor from "../lib/OrderProcessor";

    export default {
        name: "ConfirmOrder",
        components: {
            AddressView
        },
        data() {
            return {
                address: null,
                order: null,
                remark: null,
                showPopup: false,
                items: [],
                product_fee: 0,
                shipping_fee: 0,
                discount_fee: 0,
                order_fee: 0,
                submited: false
            }
        },
        mounted() {
            this.fetchData();
            this.getAddress();
        },
        methods: {
            fetchData() {
                this.$post('/order/confirm', {items: pageConfig.items}).then(response => {
                    const {items, product_fee, shipping_fee, discount_fee, order_fee} = response.result.result;
                    this.items = items;
                    this.product_fee = product_fee;
                    this.shipping_fee = shipping_fee;
                    this.discount_fee = discount_fee;
                    this.order_fee = order_fee;
                });
            },
            handleSelectedAddress(address) {
                this.address = address;
                this.showPopup = false;
            },
            handleSubmit() {
                if (!this.address) {
                    this.$toast.success('请选择收货地址');
                    return false;
                }

                //防止重复提交
                if (this.submited) {
                    return;
                } else {
                    this.submited = true;
                }

                var toast = this.$toast.loading({
                    duration: 0,
                    message: '处理中...',
                    forbidClick: true
                });
                this.$post('/order/settlement', {
                    items: pageConfig.items,
                    remark: this.remark,
                    address: this.address,
                }).then(response => {
                    //console.log(response.result);
                    this.order = response.result.order;
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
                        });
                    });
                });
            },
            getAddress() {
                this.$get('/address/get').then(response => {
                    this.address = response.result.address;
                });
            }
        },
        computed: {}
    }
</script>

<style scoped>

</style>
