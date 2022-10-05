<template>
    <div class="container">
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-list v-model="loadingMore" :finished="finished" @load="onLoadMore">
                <div class="van-pull-refresh-body">
                    <product-column-view :product-list="dataList" v-if="dataList.length"/>
                    <van-empty description="暂无此类商品" v-else/>
                </div>
            </van-list>
        </van-pull-refresh>
    </div>
</template>

<script>
    import ListMixin from "../lib/ListMixin";
    import ProductColumnView from "./components/ProductColumnView";

    export default {
        name: "ProductList",
        components: {ProductColumnView},
        mixins: [ListMixin],
        data() {
            return {
                listApi: '/ecom/product.list',
                pageSize: 20
            }
        },
        methods: {},
        mounted() {
            this.params = this.$route.query;
            this.fetchList();
        }
    }
</script>

<style lang="scss" scoped>

</style>
