<template>
    <div class="order-action-toolbar">
        <div class="flex"></div>
        <div class="order-action-button" v-if="order.order_state==1" @click="onCancel">取消订单</div>
        <div class="order-action-button" v-if="order.order_state==1" @click="onPay">付款</div>
        <div class="order-action-button" v-if="order.order_state==2" @click="onNotice">提醒卖家发货</div>
        <div class="order-action-button" v-if="order.order_state==3" @click="onConfirm">确认收货</div>
        <div class="order-action-button" v-if="order.order_state==4&&order.buyer_rate==0">评价</div>
        <div class="order-action-button" v-if="order.order_state>3">申请售后</div>
    </div>
</template>

<script>
    export default {
        name: "ActionToolBar",
        props: {
            order: Object
        },
        methods: {
            onCancel: function () {
                this.$dialog.confirm({
                    title: null,
                    message: '确认要取消订单吗?'
                }).then(() => {
                    // on confirm
                    this.$emit('cancel', this.order);
                }).catch(() => {
                    // on cancel
                });
            },
            onPay: function () {
                var _this = this;
                this.$axios.get('/h5/wechatpay/getconfig?order_id=' + this.order.order_id).then(response => {
                    console.log(response.data);
                    var config = response.data.config;
                    config.timestamp = config.timeStamp;
                    config.success = function (res) {
                        _this.$toast.success('付款成功');
                        _this.$emit('pay', _this.order);
                    };
                    wx.chooseWXPay(config);
                });
            },
            onNotice: function () {
                this.$toast.success('已提醒卖家发货');
                this.$emit('notice', this.order);
            },
            onConfirm: function () {
                this.$dialog.confirm({
                    title: null,
                    message: '请确认是否已收到货物'
                }).then(() => {
                    // on confirm
                    this.$emit('confirm', this.order);
                }).catch(() => {
                    // on cancel
                });
            }
        }
    }
</script>

<style scoped>

</style>
