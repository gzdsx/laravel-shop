<template>
    <div class="container">
        <div class="order-detail">
            <div class="order-state">
                <div class="order-state-text">
                    <span v-if="order.order_state===1">等待付款</span>
                    <span v-if="order.order_state===2">等待卖家发货</span>
                    <span v-if="order.order_state===3">等待确认</span>
                    <span v-if="order.order_state===4">交易完成</span>
                    <span v-if="order.order_state===5">退款中</span>
                    <span v-if="order.order_state===6">交易关闭</span>
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
                </div>
                <div class="goods-right">
                    <p>￥{{item.price}}</p>
                    <i>x{{item.quantity}}</i>
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
                <div class="cell-title">实付款</div>
                <div class="cell-value" style="color: #f40;">￥{{order.total_fee}}</div>
            </div>
            <div class="state-info">
                <div class="order-data-cell">订单编号: {{order.order_no}}</div>
                <div class="order-data-cell">创建时间: {{order.created_at}}</div>
                <div class="order-data-cell" v-if="order.pay_state">付款时间: {{order.pay_at}}</div>
                <div class="order-data-cell" v-if="order.pay_state">交易流水: {{order.transaction.transaction_no}}</div>
                <div class="order-data-cell" v-if="order.order_state>3">成交时间: {{order.finished_at}}</div>
            </div>
        </div>

        <div class="h60"></div>
        <div class="bottom-fixed-bar">
            <order-edit-bar :order="order" @pay="reloadOrder"></order-edit-bar>
        </div>
    </div>
</template>

<script>
    import OrderEditBar from "../common/OrderEditBar";

    export default {
        name: "OrderView",
        components: {
            OrderEditBar
        },
        data: function () {
            return {
                shipping: {},
                transaction: {},
                showCancel:false
            }
        },
        props: {
            order: Object
        },
        mounted() {

        },
        methods: {
            reloadOrder:function () {
                this.$axios.get('/bought/get?order_id=' + this.order.order_id).then(response => {
                    this.order = response.result.order;
                });
            }
        },
        watch: {
            order(val) {
                const {shipping, transaction} = val;
                if (shipping) this.shipping = shipping;
                if (transaction) this.transaction = transaction;
            }
        }
    }
</script>

<style scoped>

</style>
