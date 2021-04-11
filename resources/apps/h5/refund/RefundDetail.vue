<template>
    <div class="refund-detail">
        <h3>{{refund.refund_state_des}}</h3>
        <ul class="tips">
            <li>商家同意或者超时未处理，系统将退款给你</li>
            <li>如果商家决绝，你可以修改退款申请后再次发起，商家会重新处理</li>
        </ul>
        <div class="op-buttons">
            <van-button size="small" @click="handleRevoke" v-if="refund.refund_state<5">撤销退款</van-button>
            <van-button size="small" type="info" plain @click="handleEdit" v-if="refund.refund_state<3">修改退款协议
            </van-button>
            <van-button size="small" type="info" plain @click="handleSend" v-if="refund.refund_state===3">退货
            </van-button>
        </div>
        <div class="h30"></div>
        <h3>退款信息</h3>
        <div class="refund-info">
            <dl>
                <dt>订单号:</dt>
                <dd>{{order.order_no}}</dd>
            </dl>
            <dl>
                <dt>服务类型:</dt>
                <dd>{{refund.refund_type_des}}</dd>
            </dl>
            <dl>
                <dt>退款编号:</dt>
                <dd>{{refund.refund_no}}</dd>
            </dl>
            <dl>
                <dt>退款原因:</dt>
                <dd>{{refund.refund_reason}}</dd>
            </dl>
            <dl>
                <dt>退款金额:</dt>
                <dd>{{refund.refund_amount}}</dd>
            </dl>
            <dl>
                <dt>申请时间:</dt>
                <dd>{{refund.created_at}}</dd>
            </dl>
            <dl v-if="refund.refund_desc">
                <dt>退款说明:</dt>
                <dd>{{refund.refund_desc}}</dd>
            </dl>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RefundDetail",
        data() {
            return {
                refund: {},
                order: {}
            }
        },
        mounted() {
            const {refund_id} = this.$route.query;
            this.$get('/refund/get', {refund_id}).then(response => {
                const {refund} = response.result;
                this.refund = refund;
                this.order = refund.order;
            });
        },
        methods: {
            handleRevoke() {
                this.$dialog.confirm({
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    message: '确定要撤销此次退款申请吗?'
                }).then(() => {
                    const {refund_id} = this.refund;
                    this.$post('/refund/revoke', {refund_id}).then(response => {
                        window.history.go(-1);
                    });
                }).catch(reason => {

                });
            },
            handleEdit() {
                const {refund_id} = this.refund;
                window.location.href = 'apply?refund_id=' + refund_id;
            },
            handleSend() {
                const {refund_id} = this.refund;
                window.location.href = 'send?refund_id=' + refund_id;
            }
        }
    }
</script>

<style scoped>

</style>
