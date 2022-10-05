<template>
    <div class="container">
        <van-tabs v-model="active" sticky @change="handleTabChange">
            <van-tab v-for="(category,index) in categories" :title="category.name" :name="category.catid" :key="index"/>
        </van-tabs>
        <van-pull-refresh v-model="isRefreshing" @refresh="onRefresh">
            <product-list-view :items="items"></product-list-view>
        </van-pull-refresh>
        <tab-bar active-index="1"/>
    </div>
</template>

<script>
    import TabBar from "../common/TabBar";
    import ProductListView from "../common/ProductListView";
    import {bindLoadMore} from "../lib/loadmore";

    export default {
        name: "App",
        components: {
            TabBar,
            ProductListView
        },
        data: function () {
            return {
                active: 0,
                categories: [],
                items: [],
                searchFields: {
                    catid: ''
                },
                offset: 0,
                isLoading: true,
                isRefreshing: false,
                isLoadMore: false,
                loadMoreAble: false
            }
        },
        mounted() {
            this.fetchCategories();
            bindLoadMore(this.onLoadMore);
        },
        methods: {
            fetchList() {
                this.$get('/product/batchget',{
                    ...this.searchFields,
                    offset: this.offset
                }).then(response => {
                    if (this.isLoadMore) {
                        this.items = this.items.concat(response.result.items);
                    } else {
                        this.items = response.result.items;
                    }

                    this.isLoading = false;
                    this.isRefreshing = false;
                    this.isLoadMore = false;
                    this.loadMoreAble = response.result.items.length === 10;
                });
            },
            fetchCategories() {
                this.$get('/product/category/getall').then(response => {
                    this.categories = response.result.items;
                    if (this.categories.length > 0){
                        this.searchFields.catid = this.categories[0].catid;
                    }
                    this.fetchList();
                });
            },
            handleTabChange(val) {
                this.searchFields.catid = val;
                this.items = [];
                this.fetchList();
            },
            onRefresh() {
                if (this.isLoading || this.isLoadMore) {
                    return;
                }

                this.offset = 0;
                //this.isRefreshing = true;
                setTimeout(this.fetchList, 1000);
            },
            onLoadMore() {
                if (this.isLoading || this.isRefreshing || this.isLoadMore || !this.loadMoreAble) {
                    return;
                }
                this.offset += 10;
                this.isLoadMore = true;
                this.fetchList();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
