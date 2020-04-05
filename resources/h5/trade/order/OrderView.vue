<template>
    <div class="order-detail">
        <div class="order-state">
            <div class="order-state-text">
                <span v-if="order.order_state==1">待付款</span>
                <span v-if="order.order_state==2">待发货</span>
                <span v-if="order.order_state==3">待收货</span>
                <span v-if="order.order_state>3">交易完成</span>
            </div>
            <div class="order-state-icon">
                <span class="iconfont icon-pay" v-if="order.order_state==1"></span>
                <span class="iconfont icon-send1" v-if="order.order_state==2"></span>
                <span class="iconfont icon-deliver" v-if="order.order_state==3"></span>
                <span class="iconfont icon-evaluate" v-if="order.order_state>3"></span>
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
                    {{order.shipping.province}}{{order.shipping.city}}{{order.shipping.district}}{{order.shipping.street}}
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
        <div class="h20"></div>
        <div class="order-data-cell">订单编号: {{order.order_no}}</div>
        <div class="order-data-cell">创建时间: {{order.created_at}}</div>
        <div class="order-data-cell" v-if="order.pay_state">付款时间: {{order.pay_at}}</div>
        <div class="order-data-cell" v-if="order.order_state>3">成交时间: {{order.finished_at}}</div>
        <div class="h20"></div>
        <div class="bottom-fixed-bar">
            <action-tool-bar
                    :order="order"
                    @pay="onPay"
            ></action-tool-bar>
        </div>
    </div>
</template>

<script>
    import ActionToolBar from "../ActionToolBar";

    export default {
        name: "OrderView",
        components: {
            ActionToolBar
        },
        data: function () {
            return {}
        },
        props: {
            order: Object
        },
        methods: {
            onPay: function (res) {
                this.$axios.get('/h5/bought/get?order_id=' + this.order.order_id).then(response => {
                    this.order = response.data.order;
                });
            }
        }
    }
</script>

<style scoped>

</style>
