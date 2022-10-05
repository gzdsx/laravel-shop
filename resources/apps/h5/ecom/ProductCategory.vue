<template>
    <div class="container">
        <loading-view v-if="loading"/>
        <div class="product-category-list">
            <router-link
                    class="category-item"
                    v-for="(cate,index) in dataList"
                    :key="index"
                    :to="'/product/list?cate_id='+cate.cate_id"
            >
                <div class="category-icon">
                    <img :src="cate.image"/>
                </div>
                <div class="category-name">{{cate.cate_name}}</div>
            </router-link>
        </div>
        <tab-bar :active-index="1"/>
    </div>
</template>

<script>
    import TabBar from "../common/TabBar";

    export default {
        name: "ProductCategory",
        components: {TabBar},
        data() {
            return {
                loading: true,
                dataList: []
            }
        },
        methods: {
            fetchList() {
                this.$get('/ecom/product.category.list').then(response => {
                    this.dataList = response.result.items;
                    this.loading = false;
                })
            }
        },
        mounted() {
            this.fetchList();
        }
    }
</script>

<style scoped>

</style>
