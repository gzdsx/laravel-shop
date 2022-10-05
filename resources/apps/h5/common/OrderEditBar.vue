<template>
    <div class="order-edit-bar">
        <div class="flex"></div>
        <slot></slot>
        <div class="order-edit-button" v-if="order.shipping_state===1" @click="onShipping">查看物流</div>
        <div class="order-edit-button" v-if="order.order_state===0" @click="onCancel">取消订单</div>
        <div class="order-edit-button" v-if="order.order_state===0" @click="onPay">付款</div>
        <div class="order-edit-button" v-if="order.order_state===1" @click="onNotice">提醒发货</div>
        <div class="order-edit-button" v-if="order.order_state===2" @click="onConfirm">确认收货</div>
        <div class="order-edit-button" v-if="order.order_state===3&&order.buyer_rate===0" @click="onRate">评价</div>
        <div class="order-edit-button" v-if="order.order_state===20" @click="onDelete">删除订单</div>
        <van-action-sheet
                v-model="showActionSheet"
                :actions="reasons"
                @select="onSelectReason"
                @close="onCloseActionSheet"
                cancel-text="取消"
                :round="false"
                get-container="body"
        />
    </div>
</template>

<script>
    export default {
        name: "OrderEditBar",
        data() {
            return {}
        },
        props: {
            order: {},
            reasons: [],
            showActionSheet: false
        },
        mounted() {
        },
        methods: {
            onCancel(val) {
                this.showActionSheet = true;
            },
            onPay() {
                let that = this;
                let type = 'balance';
                let {order_id} = this.order;
                that.$emit('pay', that.order);
                // this.$post('/order/pay', {order_id, type}).then(response => {
                //     if (type === 'wechatpay') {
                //         let {config} = response.data.result;
                //         if (!config.timestamp) {
                //             config.timestamp = config.timeStamp;
                //         }
                //         config.success = function (res) {
                //             that.$emit('pay', that.order);
                //         }
                //
                //         config.cancel = function (res) {
                //
                //         }
                //
                //         config.fail = function (res) {
                //             that.$emit('payFail', res);
                //         }
                //
                //         wx.chooseWXPay(config);
                //     }
                //
                //     if (type === 'balance') {
                //         that.$emit('pay', this.order);
                //     }
                //
                // }).catch(reason => {
                //     this.$toast.fail(reason.errMsg);
                //     that.$emit('payFail', reason);
                // });
            },
            onNotice() {
                const {order_id} = this.order;
                this.$post('/bought/notice', {order_id}).then(response => {
                    this.$toast.success({
                        message: '已提醒卖家发货',
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
                    this.$post('/bought/confirm', {order_id}).then(response => {
                        this.$toast.success({
                            message: '确认收货成功',
                            onClose: () => {
                                this.$emit('confirm', this.order);
                            }
                        });
                    }).catch(reason => {
                        this.$toast.fail(reason.errMsg);
                    });
                }).catch(() => {
                    // on cancel
                });
            },
            onDelete() {
                const {order_id} = this.order;
                this.$dialog.confirm({
                    title: '删除确认',
                    message: '确认要删除此订单吗?'
                }).then(() => {
                    this.$post('/bought/delete', {order_id}).then(response => {
                        this.$emit('delete', this.order);
                    });
                }).catch(() => {
                    // on cancel
                });
            },
            onRate() {
                window.location.href = '/h5/order/rate?order_id=' + this.order.order_id
            },
            onShipping() {
                this.$emit('shipping', this.order);
            },
            onSelectReason(val) {
                this.showActionSheet = false;
                const {order_id} = this.order;
                const reason = val.name;
                this.$post('/bought/cancel', {order_id, reason}).then(response => {
                    this.$emit('cancel', this.order);
                }).catch(reason1 => {
                    this.$toast.fail(reason1.errMsg);
                });
            },
            onCloseActionSheet() {
                this.$emit('update:showActionSheet', false);
            }
        }
    }
</script>

<style scoped>

</style>
