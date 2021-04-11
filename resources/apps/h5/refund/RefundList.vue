<template>
    <div class="refund-list">
        <div class="refund-list-item" v-for="(refund,index) in refunds" :key="index">
            <div class="refund-no">退款编号:{{refund.refund_no}}</div>
            <div class="refund-order-item" v-for="(item,idx) in refund.items">
                <img :src="item.thumb" class="thumb" alt="">
                <div class="meta">
                    <div class="title">{{item.title}}</div>
                    <div class="sku-title" v-if="item.sku_id">{{item.sku_title}}</div>
                </div>
            </div>
            <div class="refund-state" v-if="refund.refund_state===5">
                <strong>退款成功</strong>
                <span>退款金额￥{{refund.refund_amount}}</span>
            </div>
            <div class="refund-state" v-if="refund.refund_state===6">
                <strong>退款关闭</strong>
                <span>退款关闭</span>
            </div>
            <div class="refund-state" v-if="refund.refund_state<5">
                <strong>退款中</strong>
                <span>{{refund.refund_state_des}}</span>
            </div>
            <div class="refund-actions">
                <div class="refund-action-button" v-if="refund.refund_state>4" @click="onDelete(refund.refund_id)">
                    删除记录
                </div>
                <div class="refund-action-button" v-if="refund.refund_state<4" @click="onRevoke(refund.refund_id)">
                    撤销退款
                </div>
                <router-link :to="'/h5/refund/detail?refund_id='+refund.refund_id" class="refund-action-button">查看详情</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RefundList",
        data() {
            return {
                refunds: []
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.$get('/refund/batchget').then(response => {
                    this.refunds = response.result.items;
                });
            },
            onRevoke(refund_id) {
                this.$dialog.confirm({
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    message: '确定要撤销此次退款申请吗?'
                }).then(() => {
                    this.$post('/refund/revoke', {refund_id}).then(response => {
                        this.fetchData();
                    });
                }).catch(reason => {

                });
            },
            onDelete(refund_id) {
                this.$post('/refund/delete', {items: [refund_id]}).then(response => {
                    this.fetchData();
                });
            }
        }
    }
</script>

<style scoped>

</style>
