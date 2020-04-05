<template>
    <div class="container">
        <order-view :order="order" v-if="order"></order-view>
        <div class="buynow" v-else>
            <div class="address" @click="onClickAddress" v-if="address_DATA">
                <div>
                    <span>{{address_DATA.name}}</span>
                    <span>{{address_DATA.tel}}</span>
                </div>
                <p>{{address_DATA.addressText}}</p>
            </div>
            <div class="address"  @click="onClickAddress" v-else>
                <div class="addaddress">
                    <span class="iconfont icon-add"></span>
                    <span>添加收货地址</span>
                </div>
            </div>
            <div class="h10"></div>
            <div class="buynow-goods-info">
                <div class="title">商品信息</div>
                <div class="goods-item">
                    <div class="bg-cover image" :style="'background-image: url('+item_DATA.thumb+')'"></div>
                    <div class="data">
                        <div class="goods-title">{{item_DATA.title}}</div>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="goods-price">￥{{item_DATA.price}}</div>
                            <div>
                                <van-stepper
                                        :default-value="quantity"
                                        v-model="quantity"
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
                        <input type="text" class="message" placeholder="建议留言前先与商家沟通确认" v-model="message">
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
                <address-view @select="onSelectedAddress"></address-view>
            </van-popup>
        </div>
    </div>
</template>

<script>
    import AddressView from '../../address/App';
    import OrderView from "../../trade/order/OrderView";

    export default {
        name: "App",
        data: function () {
            return {
                item_DATA,
                address_DATA,
                showPopup: false,
                quantity: 1,
                order: null,
                message: null
            }
        },
        components: {
            AddressView,
            OrderView
        },
        methods: {
            onClickAddress: function () {
                this.showPopup = true;
            },
            onSelectedAddress: function (address) {
                this.$axios.get('/h5/address/get?address_id=' + address.id).then(response => {
                    this.address_DATA = response.data.address;
                    this.showPopup = false;
                });
            },
            onSubmit: function () {
                if (!this.address_DATA) {
                    $this.$toast.success('请选择收货地址');
                    return false;
                }

                this.$axios.post('/h5/order/create', {
                    itemid: this.item_DATA.itemid,
                    quantity: this.quantity,
                    address_id: this.address_DATA.address_id,
                    buyer_message: this.message
                }).then(response => {
                    console.log(response.data);
                    this.order = response.data.order;
                });
            }
        },
        computed: {
            goodsFee: function () {
                return (this.item_DATA.price * this.quantity).toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
