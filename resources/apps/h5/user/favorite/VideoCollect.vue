<template>
    <van-pull-refresh v-model="refreshing">
        <van-cell
                v-for="(item,index) in items"
                size="large"
                :title="item.video.title"
                :key="index"
                :url="item.video.m_url"
        />
    </van-pull-refresh>
</template>

<script>
    export default {
        name: "PostCollect",
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
                this.$get('/video/collect/batchget', {
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
