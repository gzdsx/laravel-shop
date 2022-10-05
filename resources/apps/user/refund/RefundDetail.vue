<template>
    <div class="flex-fill" v-else>
        <div class="refund-info" v-if="refund.refund_id">
            <h3>你已成功发起退款申请，请耐心等待商家确认。</h3>
            <ul class="tips">
                <li>商家同意或者超时未处理，系统将退款给你</li>
                <li>如果商家决绝，你可以修改退款申请后再次发起，商家会重新处理</li>
            </ul>
            <div class="op-buttons">
                <el-button size="small" @click="handleRevoke">撤销申请</el-button>
                <el-button size="small" type="primary" plain @click="handleEdit">修改申请</el-button>
            </div>
            <div class="h30"></div>
            <h3>退款信息</h3>
            <div class="refund-info-detail">
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
                <dl>
                    <dt>退款编号:</dt>
                    <dd>{{refund.refund_no}}</dd>
                </dl>
                <dl v-if="refund.refund_desc">
                    <dt>退款说明:</dt>
                    <dd>{{refund.refund_desc}}</dd>
                </dl>
            </div>
        </div>
        <div class="h20"></div>
    </div>
</template>

<script>
    export default {
        name: "RefundDetail",
        data() {
            return {
                refund: {}
            }
        },
        mounted() {
            this.refund_id = this.$route.query.refund_id;
            this.fetchData();
        },
        methods: {
            fetchData() {
                const refund_id = this.refund_id;
                this.$get('/refund/get', {refund_id}).then(response => {
                    this.refund = response.result.refund;
                });
            },
            handleRevoke() {
                this.$confirm('确定要撤销此次退款申请吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    const {refund_id} = this.refund;
                    this.$post('/refund/revoke', {refund_id}).then(response => {
                        this.fetchData();
                    });
                });
            },
            handleEdit() {
                const {refund_id} = this.refund;
                this.$router.push({path: '/refund/apply', query: {refund_id}});
            }
        }
    }
</script>

<style scoped>

</style>
