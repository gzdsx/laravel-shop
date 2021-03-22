<template>
    <div class="container">
        <van-search
                v-model="searchFields.q"
                :show-action="false"
                placeholder="请输入搜索关键词"
                @search="onSearch"
                clearable
        />
        <van-tabs v-model="searchFields.sort" sticky @change="handleTabChange">
            <van-tab title="综合" name="default"/>
            <van-tab title="新上" name="time-desc"/>
            <van-tab title="热卖" name="sale-desc"/>
        </van-tabs>
        <van-pull-refresh v-model="isRefreshing" @refresh="onRefresh">
            <product-list-view :items="items"></product-list-view>
        </van-pull-refresh>
    </div>
</template>

<script>
    import ProductListView from "../common/ProductListView";
    import {bindLoadMore} from "../lib/loadmore";

    export default {
        name: "ProductSearch",
        components: {
            ProductListView
        },
        data () {
            return {
                ...pageConfig,
                items: [],
                offset: 0,
                isLoading: true,
                isRefreshing: false,
                isLoadMore: false,
                loadMoreAble: false
            }
        },
        mounted() {
            bindLoadMore(this.onLoadMore);
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/product/batchget',{
                    ...this.searchFields,
                    offset: this.offset
                }).then(response => {
                    if (this.isLoadMore) {
                        this.items = this.items.concat(response.data.items);
                    } else {
                        this.items = response.data.items;
                    }

                    this.isLoading = false;
                    this.isRefreshing = false;
                    this.isLoadMore = false;
                    this.loadMoreAble = response.data.items.length === 10;
                });
            },
            handleTabChange(val) {
                //this.searchFields.sort = val;
                this.onSearch();
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
            },
            onSearch(){
                this.items = [];
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
