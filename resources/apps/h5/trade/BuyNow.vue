<template>
    <loading-view v-if="loading"/>
    <div class="container" v-else>
        <div class="auction">
            <div class="cell-arrow-right" @click="showPopup=true">
                <div class="shipping-address" v-if="address.id">
                    <div class="icon-wrapper">
                        <i class="iconfont icon-location"></i>
                    </div>
                    <div class="flex">
                        <div>
                            <span>{{address.name}}</span>
                            <span>{{address.phone}}</span>
                        </div>
                        <p>{{address.formatted_address}}</p>
                    </div>
                </div>
                <div class="shipping-address" v-else>
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
                        <div class="goods-sku" v-if="sku.sku_id">{{sku.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="goods-price">￥{{sku.price}}</div>
                            <div>
                                <van-stepper
                                        :default-value="quantity"
                                        v-model="quantity"
                                        :max="sku.stock"
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
        </div>
        <van-submit-bar
                :price="order_fee*100"
                button-text="提交订单"
                @submit="onSubmit"
        />
        <van-popup v-model="showPopup" position="bottom">
            <address-list @select="onChooseAddress"/>
        </van-popup>
    </div>
</template>

<script>
    import AddressList from "../home/AddressList";

    export default {
        name: "BuyNow",
        components: {
            AddressList
        },
        props: {},
        data() {
            const {quantity, pay_type, shipping_type} = this.$route.query;
            return {
                order: {},
                remark: '',
                showPopup: false,
                address: {},
                product: {},
                sku: {},
                product_fee: 0,
                shipping_fee: 0,
                discount_fee: 0,
                order_fee: 0,
                quantity,
                pay_type,
                shipping_type,
                loading: true
            }
        },
        methods: {
            fetchData() {
                const {itemid, sku_id} = this.$route.query;
                const quantity = this.quantity;
                this.$post('/ecom/order.calculate', {itemid, sku_id, quantity}).then(response => {
                    const {product, sku, quantity, product_fee, shipping_fee, discount_fee, order_fee} = response.result;
                    this.product = product;
                    this.sku = sku;
                    this.quantity = quantity;
                    this.product_fee = product_fee;
                    this.shipping_fee = shipping_fee;
                    this.discount_fee = discount_fee;
                    this.order_fee = order_fee;
                    this.loading = false;
                }).catch(reason => {
                    this.$toast.fail(reason.data.errmsg);
                });
            },
            onChooseAddress(address) {
                this.address = address;
                this.showPopup = false;
            },
            onSubmit() {
                let that = this;
                if (!this.address.id) {
                    this.$toast.fail('请选择收货地址');
                    return false;
                }

                let toast = this.$toast.loading({
                    duration: 0,
                    message: '处理中...',
                    forbidClick: true
                });

                this.$post('/ecom/order.create', {
                    itemid: this.product.itemid,
                    quantity: this.quantity,
                    address: this.address,
                    remark: this.remark,
                    sku_id: this.sku ? this.sku.sku_id : 0
                }).then(response => {
                    this.$toast.clear();
                    const {order_id} = response.result;
                    //window.location.replace('/h5/bought/detail?order_id=' + order_id);
                    let openid = localStorage.getItem('openid');
                    this.$post('/trade/order.pay', {order_id, openid, type: 'wechatpay'}).then(response => {
                        let config = response.result;
                        if (!config.timestamp) {
                            config.timestamp = config.timeStamp;
                        }
                        config.success = function (res) {
                            that.$router.replace('/bought/detail/' + order_id)
                        }

                        config.cancel = function (res) {
                            that.$router.replace('/bought/detail/' + order_id)
                        }

                        config.fail = function (res) {
                            that.$toast.fail(res.errMsg);
                        }

                        wx.chooseWXPay(config);
                    }).catch(reason => {
                        this.$toast.fail(reason.errMsg);
                    });
                }).catch(r => {
                    this.$toast.fail(r.errMsg);
                });
            },
            getAddress() {
                this.$get('/user/address.info').then(response => {
                    this.address = response.result;
                });
            }
        },
        watch: {
            quantity() {
                this.fetchData();
            }
        },
        mounted() {
            this.fetchData();
            this.getAddress();
        },
    }
</script>

<style scoped>

</style>
