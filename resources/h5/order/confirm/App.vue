<template>
    <div class="container">
        <order-view :order="order" v-if="order"></order-view>
        <div class="buynow" v-else>
            <div class="address" @click="onClickAddress" v-if="address">
                <div>
                    <span>{{address.name}}</span>
                    <span>{{address.tel}}</span>
                </div>
                <p>{{address.addressText}}</p>
            </div>
            <div class="address" v-else>
                <div class="addaddress">
                    <span class="iconfont icon-add"></span>
                    <span>添加收货地址</span>
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
                        <input type="text" class="message" v-model="message" placeholder="建议留言前先与商家沟通确认">
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
                    @submit="onSubmit"
            />
            <van-popup v-model="showPopup" position="bottom">
                <address-view @select="onSelectedAddress"/>
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
                items: $confirmData.items,
                address: $confirmData.address,
                showPopup: false,
                order: null,
                message:null
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
                    this.address = response.data.address;
                    this.showPopup = false;
                });
            },
            onSubmit: function () {
                if (!this.address) {
                    this.$toast.success('请选择收货地址');
                    return false;
                }

                var items = [];
                this.items.map((d)=>{
                    items.push(d.itemid);
                });

                this.$axios.post('/h5/order/settlement', {
                    address_id: this.address.address_id,
                    items,
                    buyer_message:this.message
                }).then(response => {
                    console.log(response.data);
                    this.order = response.data.order;
                });
            }
        },
        computed: {
            goodsFee: function () {
                var total = 0;
                this.items.map((d,i)=>{
                    total+= d.price * d.quantity;
                });
                return total.toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
