<template>
    <van-pull-refresh>
        <div class="item-list-view">
            <div class="items">
                <div class="item" v-for="item in items" :key="item.itemid">
                    <a :href="item.product.m_url">
                        <div class="inner">
                            <div class="pic-box">
                                <img :src="item.image" class="pic" alt="">
                            </div>
                            <div class="ctx-box">
                                <div class="title">{{item.title}}</div>
                                <div class="flex"></div>
                                <div class="flex-row align-items-center">
                                    <span class="sold">收藏时间:{{item.created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </van-pull-refresh>
</template>

<script>
    export default {
        name: "ProductCollect",
        data() {
            return {
                items: [],
                offset: 0,
                loading: true,
                refreshing: false,
                loadMore: false,
                loadMoreAble: false,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/product/collect/batchget', {
                    offset: this.offset
                }).then(response => {
                    if (this.loadMore) {
                        this.items = this.items.concat(response.result.items);
                    } else {
                        this.items = response.result.items;
                    }

                    this.loading = false;
                    this.refreshing = false;
                    this.loadMore = false;
                    this.loadMoreAble = response.result.items.length === 10;
                });
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
            }
        }
    }
</script>

<style scoped>

</style>
