<template>
    <div class="refund">
        <van-cell-group>
            <van-cell size="large">
                <strong slot="title">退款商品</strong>
            </van-cell>
            <van-cell>
                <div class="refund-item">
                    <div class="refund-item-pic">
                        <img :src="item.thumb" class="pic" alt="">
                    </div>
                    <div class="flex-fill flex-column">
                        <div class="refund-item-title">{{item.title}}</div>
                        <div class="refund-item-sku">{{item.sku_title}}</div>
                        <div class="flex-fill"></div>
                        <div class="flex-row">
                            <div class="flex-fill">￥{{item.price}}</div>
                            <div>x{{item.quantity}}</div>
                        </div>
                    </div>
                </div>
            </van-cell>
        </van-cell-group>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell size="large">
                <strong slot="title">选择服务类型</strong>
            </van-cell>
            <van-cell
                    size="large"
                    title="我要退款(无需退货)"
                    label="没有收到货，或与卖家协商同意不用退货只退款"
                    is-link
                    center
                    @click="showApply(1)"
            ></van-cell>
            <van-cell
                    size="large"
                    title="我要退货退款"
                    label="已收到货，需要退还收到的货物"
                    is-link
                    center
                    @click="showApply(2)"
            ></van-cell>
        </van-cell-group>
    </div>
</template>

<script>
    export default {
        name: "RefundRouter",
        data() {
            return {
                item: {}
            }
        },
        mounted() {
            const {sub_order_id} = this.$route.query;
            this.$get('/bought/getitem', {sub_order_id}).then(response => {
                this.item = response.result.item;
            });
        },
        methods: {
            showApply(refund_type) {
                const {order_id, sub_order_id} = this.item;
                this.$router.push({path: '/refund/apply', query: {order_id, sub_order_id, refund_type}});
            }
        }
    }
</script>

<style scoped>

</style>
