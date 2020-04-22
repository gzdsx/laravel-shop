<template>
    <div class="order-detail">
        <div class="order-state">
            <div class="order-state-text">
                <span>{{order.seller_state_des}}</span>
            </div>
            <div class="order-state-icon">
                <span class="iconfont icon-pay" v-if="order.order_state===1"></span>
                <span class="iconfont icon-send1" v-if="order.order_state===2"></span>
                <span class="iconfont icon-deliver" v-if="order.order_state===3"></span>
                <span class="iconfont icon-evaluate" v-if="order.order_state===4"></span>
                <span class="iconfont icon-refund" v-if="order.order_state===5"></span>
                <span class="iconfont icon-close-circle" v-if="order.order_state===6"></span>
            </div>
        </div>
        <div class="shipping-address" v-if="order.shipping">
            <div class="shipping-address-icon">
                <span class="iconfont icon-location"></span>
            </div>
            <div class="flex">
                <div class="display-flex">
                    <div class="flex">{{order.shipping.name}}</div>
                    <div>{{order.shipping.tel}}</div>
                </div>
                <div>
                    {{order.shipping.full_address}}
                </div>
            </div>
        </div>
        <div class="order-section-title">商品信息</div>
        <div class="goods-item" v-for="(item,index) in order.items" :key="index">
            <div class="bg-cover goods-image" :style="'background-image: url('+item.thumb+')'"></div>
            <div class="goods-center">
                <div class="goods-title">{{item.title}}</div>
                <div class="flex"></div>
            </div>
            <div class="goods-right">
                <p>￥{{item.price}}</p>
                <i>x{{item.quantity}}</i>
                <p v-if="order.order_state===1"><a @click="handleShowEdit(item)" style="color: dodgerblue;">修改价格</a></p>
            </div>
        </div>
        <div class="order-info-cell">
            <div class="cell-title">商品总价</div>
            <div class="cell-value">￥{{order.order_fee}}</div>
        </div>
        <div class="order-info-cell">
            <div class="cell-title">运费</div>
            <div class="cell-value">￥{{order.shipping_fee}}</div>
        </div>
        <div class="order-info-cell">
            <div class="cell-title">订单总额</div>
            <div class="cell-value" style="color: #f40;">￥{{order.total_fee}}</div>
        </div>
        <div class="h20"></div>
        <div class="order-data-cell">订单编号: {{order.order_no}}</div>
        <div class="order-data-cell">创建时间: {{order.created_at}}</div>
        <div class="order-data-cell" v-if="order.pay_state">付款时间: {{order.pay_at}}</div>
        <div class="order-data-cell" v-if="order.order_state>3">成交时间: {{order.finished_at}}</div>
        <div class="h20"></div>
        <div v-if="order.shipping_state">
            <h3 style="font-size: 16px;padding: 0 10px; margin-bottom: 10px;">发货信息</h3>
            <div class="order-data-cell">快递名称: {{order.shipping.express_name}}</div>
            <div class="order-data-cell">快递单号: {{order.shipping.express_no}}</div>
            <div class="order-data-cell">发货时间: {{order.shipping_at}}</div>
            <div class="order-data-cell">收 货 人: {{order.shipping.name}}</div>
            <div class="order-data-cell">联系电话: {{order.shipping.tel}}</div>
            <div class="order-data-cell">收货地址: {{order.shipping.full_address}}</div>
            <div class="h20"></div>
        </div>
        <send-view @send="handleSend" v-if="order.order_state===2"/>
        <van-popup position="bottom" title="修改价格" v-model="showPopup" closeable>
            <edit-price :item="editItem" @save="handleSavePrice"></edit-price>
        </van-popup>
    </div>
</template>

<script>
    import SendView from "./SendView";
    import EditPrice from "./EditPrice";

    export default {
        name: "OrderDetail",
        components: {
            SendView,
            EditPrice
        },
        data: function () {
            return {
                order_id,
                order: {},
                showPopup: false,
                editItem: {}
            }
        },
        props: {},
        mounted() {
            this.getOrder();
        },
        methods: {
            handleSend: function (c) {
                this.$axios.post('/webapi/sold/send', {
                    ...c,
                    order_id: this.order.order_id
                }).then(response => {
                    this.$toast.success('发货成功');
                    this.getOrder();
                });
            },
            handleSavePrice: function (item) {
                this.getOrder();
                this.showPopup = false;
            },
            handleShowEdit(item){
                this.editItem = item;
                this.showPopup = true;
            },
            getOrder() {
                this.$get('/webapi/sold/get?order_id=' + this.order_id).then(response => {
                    this.order = response.data.order;
                });
            }
        }
    }
</script>

<style scoped>

</style>
