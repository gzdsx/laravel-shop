<template>
    <div class="order-edit-bar">
        <div class="flex"></div>
        <slot></slot>
        <div class="order-edit-button" v-if="order.order_state===1" @click="onCancel">取消订单</div>
        <div class="order-edit-button" v-if="order.order_state===1" @click="onPay">付款</div>
        <div class="order-edit-button" v-if="order.order_state===2" @click="onRefund">申请退款</div>
        <div class="order-edit-button" v-if="order.order_state===2" @click="onNotice">提醒卖家发货</div>
        <div class="order-edit-button" v-if="order.order_state===3" @click="onConfirm">确认收货</div>
        <div class="order-edit-button" v-if="order.order_state===4&&order.buyer_rate===0">评价</div>
        <div class="order-edit-button" v-if="order.order_state===6" @click="onDelete">删除订单</div>
    </div>
</template>

<script>
    export default {
        name: "OrderEditBar",
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
                    this.$axios.post('/webapi/bought/close', {
                        order_id: this.order.order_id,
                        reason: '拍错了，不想要了'
                    }).then(response => {
                        this.$emit('cancel', this.order);
                    });
                }).catch(() => {
                    // on cancel
                });
            },
            onPay: function () {
                var _this = this;
                this.$axios.get('/webapi/wechatpay/getconfig?transaction_id=' + this.order.transaction_id).then(response => {
                    //console.log(response.data);
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
                this.$axios.post('/webapi/bought/notice', {
                    order_id: this.order.order_id
                }).then(response => {
                    this.$toast.success('已提醒卖家发货');
                    this.$emit('notice', this.order);
                });
            },
            onConfirm: function () {
                this.$dialog.confirm({
                    title: null,
                    message: '请确认是否已收到货物'
                }).then(() => {
                    // on confirm
                    this.$axios.post('/webapi/bought/confirm', {
                        order_id: this.order.order_id
                    }).then(response => {
                        this.$toast.success('已提醒卖家发货');
                        this.$emit('confirm', this.order);
                    });
                }).catch(() => {
                    // on cancel
                });
            },
            onRefund: function () {
                this.$dialog.confirm({
                    title: null,
                    message: '你确认要申请退款吗?'
                }).then(() => {
                    // on confirm
                    this.$axios.post('/webapi/bought/refund', {
                        order_id: this.order.order_id
                    }).then(response => {
                        this.$toast.success('退款成功');
                        this.$emit('refund', this.order);
                    });
                }).catch(() => {
                    // on cancel
                });
            },
            onDelete: function () {
                this.$axios.post('/webapi/bought/delete', {
                    order_id: this.order.order_id
                }).then(response => {
                    this.$emit('delete', this.order);
                });
            }
        }
    }
</script>

<style scoped>

</style>
