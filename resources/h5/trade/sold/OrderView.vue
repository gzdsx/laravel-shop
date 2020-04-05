<template>
    <div class="order-detail">
        <div class="order-state">
            <div class="order-state-text">
                <span v-if="order.order_state==1">等待买家付款</span>
                <span v-if="order.order_state==2">买家已付款</span>
                <span v-if="order.order_state==3">已发货</span>
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
                    {{order.shipping.address_text}}
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
            <div class="order-data-cell">收货地址: {{order.shipping.address_text}}</div>
            <div class="h20"></div>
        </div>
        <send-view :expresses="expresses" @send="onSend" v-if="order.order_state===2"/>
    </div>
</template>

<script>
    import SendView from "./SendView";

    export default {
        name: "Order",
        components: {
            SendView
        },
        data: function () {
            return {
                order,
                expresses: []
            }
        },
        props: {},
        mounted() {
            var columns = [];
            expresses.map((d, i) => {
                columns.push({
                    text: d.name,
                    id: d.id
                });
            });
            this.expresses = columns;
        },
        methods: {
            onSend: function (c) {
                console.log({
                    ...c,
                    order_id: this.order.order_id
                });
                this.$axios.post('/h5/trade/sold/send', {
                    ...c,
                    order_id: this.order.order_id
                }).then(response => {
                    this.$toast.success('发货成功');
                    this.order.order_state = 3;
                });
            }
        }
    }
</script>

<style scoped>

</style>
