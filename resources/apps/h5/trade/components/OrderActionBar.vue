<template>
    <div class="order-action-bar">
        <div class="flex"></div>
        <slot></slot>
        <div class="btn-action" v-if="order.shipping_state===1" @click="onShipping">查看物流</div>
        <div class="btn-action" v-if="order.order_state===0" @click="onCancel">取消订单</div>
        <div class="btn-action" v-if="order.order_state===0" @click="onPay">付款</div>
        <div class="btn-action" v-if="order.order_state===1" @click="onNotice">提醒发货</div>
        <div class="btn-action" v-if="order.order_state===2" @click="onConfirm">确认收货</div>
        <div class="btn-action" v-if="order.order_state===3&&order.buyer_rate===0" @click="onRate">评价</div>
        <div class="btn-action" v-if="order.order_state===20" @click="onDelete">删除订单</div>
    </div>
</template>

<script>
    export default {
        name: "OrderActionBar",
        data() {
            return {}
        },
        props: {
            order: {
                type: Object,
                default() {
                    return {}
                }
            },
        },
        mounted() {
        },
        methods: {
            onCancel() {
                this.$emit('cancel', this.order);
            },
            onPay() {
                let that = this;
                let type = 'wechatpay';
                let {order_id} = this.order;
                let openid = localStorage.getItem('openid');
                //that.$emit('pay', that.order);
                this.$post('/trade/order.pay', {order_id, type, openid}).then(response => {
                    if (type === 'wechatpay') {
                        let config = response.result;
                        if (!config.timestamp) {
                            config.timestamp = config.timeStamp;
                        }
                        config.success = function (res) {
                            that.$emit('paid', that.order);
                        }

                        config.cancel = function (res) {
                            that.$emit('payFail', res);
                        }

                        config.fail = function (res) {
                            that.$emit('payFail', res);
                        }

                        wx.chooseWXPay(config);
                    }

                    if (type === 'balance') {
                        that.$emit('paid', this.order);
                    }
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                    that.$emit('payFail', reason);
                });
            },
            onNotice() {
                const {order_id} = this.order;
                this.$post('/trade/bought.notice', {order_id}).then(response => {
                    this.$toast.success({
                        message: '已成功提醒卖家发货',
                        onClose: () => {
                            this.$emit('notice', this.order);
                        }
                    });
                });
            },
            onConfirm() {
                const {order_id} = this.order;
                this.$dialog.confirm({
                    title: '确认收货',
                    message: '在确认收货之前请检查已收到货物是否完好'
                }).then(() => {
                    // on confirm
                    this.$post('/trade/bought.confirm', {order_id}).then(response => {
                        this.$toast.success({
                            message: '确认收货成功',
                            onClose: () => {
                                this.$emit('confirm', this.order);
                            }
                        });
                    }).catch(reason => {
                        this.$toast.fail(reason.errMsg);
                    });
                });
            },
            onDelete() {
                const {order_id} = this.order;
                this.$dialog.confirm({
                    title: '删除确认',
                    message: '确认要删除此订单吗?'
                }).then(() => {
                    this.$post('/trade/bought.delete', {order_id}).then(response => {
                        this.$emit('delete', this.order);
                    });
                });
            },
            onRate() {

            },
            onShipping() {
                this.$emit('shipping', this.order);
            },
        }
    }
</script>

<style scoped>

</style>
