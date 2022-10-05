<template>
    <div class="container">
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
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
        data() {
            return {
                ...pageConfig,
                items: [],
                offset: 0,
                pageSize: 10,
                loading: true,
                refreshing: false,
                loadMore: false,
                loadMoreAble: false
            }
        },
        mounted() {
            bindLoadMore(this.onLoadMore);
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/ecom/product/list', {
                    ...this.searchFields,
                    offset: this.offset,
                    count: this.pageSize
                }).then(response => {
                    if (this.loadMore) {
                        this.items = this.items.concat(response.result.items);
                    } else {
                        this.items = response.result.items;
                    }

                    this.loading = false;
                    this.refreshing = false;
                    this.loadMore = false;
                    this.loadMoreAble = response.result.items.length === this.pageSize;
                });
            },
            handleTabChange(val) {
                //this.searchFields.sort = val;
                this.onSearch();
            },
            onRefresh() {
                if (this.loading || this.loadMore) {
                    return;
                }

                this.offset = 0;
                //this.isRefreshing = true;
                setTimeout(this.fetchList, 1000);
            },
            onLoadMore() {
                if (this.loading || this.refreshing || this.loadMore || !this.loadMoreAble) {
                    return;
                }
                this.offset += 10;
                this.loadMore = true;
                this.fetchList();
            },
            onSearch() {
                this.items = [];
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
