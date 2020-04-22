<template>
    <order-view :order="order" v-if="order"></order-view>
    <div class="container" v-else>
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
                    <div class="bg-cover image" :style="'background-image: url('+item.thumb+')'"></div>
                    <div class="data">
                        <div class="goods-title">{{item.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="goods-price">￥{{item.price}}</div>
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
                    <div class="cell-title flex">商品金额</div>
                    <div class="cell-value">￥{{goodsFee}}</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">运费</div>
                    <div class="cell-value">￥0.00</div>
                </div>
                <div class="buynow-cell">
                    <div class="cell-title flex">合计</div>
                    <div class="cell-value amount">￥{{goodsFee}}</div>
                </div>
            </div>
            <van-submit-bar
                    :price="goodsFee*100"
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
    import AddressView from '../user/Address';
    import OrderView from "../components/OrderView";

    export default {
        name: "ConfirmOrder",
        components: {
            AddressView,
            OrderView
        },
        props: {
            items: []
        },
        data: function () {
            return {
                address: null,
                showPopup: false,
                order: null,
                remark: null
            }
        },
        mounted() {
            this.getAddress();
        },
        methods: {
            handleSelectedAddress: function (address) {
                this.address = address;
                this.showPopup = false;
            },
            handleSubmit: function () {
                if (!this.address) {
                    this.$toast.success('请选择收货地址');
                    return false;
                }

                var items = this.items.map((d) => d.itemid);
                this.$axios.post('/webapi/order/settlement', {
                    items,
                    remark: this.remark,
                    address_id: this.address.address_id,
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
                var total = this.items.reduce((a, b) => a + b.price * b.quantity, 0);
                return total.toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
