<template>
    <div class="content-block">
        <div class="console-title">
            <h2>订单管理->评价订单</h2>
        </div>

        <section>
            <div v-for="(item,index) in order.items" :key="index">
                <table class="dsxui-formtable">
                    <colgroup>
                        <col style="width: 75px;">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <div class="flex-row">
                                <img :src="item.thumb" class="img-50" style="margin-right: 20px;" alt="">
                                <div class="flex">{{item.title}}</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>商品评分</td>
                        <td>
                            <el-rate v-model="reviews[index].item_star"></el-rate>
                        </td>
                    </tr>
                    <tr>
                        <td>服务评分</td>
                        <td>
                            <el-rate v-model="reviews[index].service_star"></el-rate>
                        </td>
                    </tr>
                    <tr>
                        <td>物流评分</td>
                        <td>
                            <el-rate v-model="reviews[index].wuliu_star"></el-rate>
                        </td>
                    </tr>
                    <tr>
                        <td>评价商品</td>
                        <td>
                            <el-input type="textarea" rows="5" class="w300" v-model="reviews[index].message"></el-input>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="dsxui-formtable">
                    <colgroup>
                        <col style="width: 75px;">
                        <col>
                    </colgroup>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td>
                            <el-button type="primary" size="medium" class="w120" @click="handleSubmit">提交</el-button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "BoughtRate",
        data() {
            return {
                order: {},
                reviews: []
            }
        },
        mounted() {
            this.order_id = this.$route.query.order_id;
            this.fetchData();
        },
        methods: {
            fetchData() {
                const order_id = this.order_id;
                this.$get('/bought/get', {order_id}).then(response => {
                    this.order = response.result.order;
                    this.reviews = this.order.items.map(it => {
                        return {
                            itemid: it.itemid,
                            order_id: this.order_id,
                            message: '',
                            item_star: 0,
                            service_star: 0,
                            wuliu_star: 0
                        };
                    });
                });
            },
            handleSubmit() {
                if (!this.order.buyer_rate) {
                    const reviews = this.reviews;
                    const order_id = this.order_id;
                    this.$post('/bought/rate', {reviews, order_id}).then(response => {
                        this.$showToast('商品评价成功', this.$router.go(-1));
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>
