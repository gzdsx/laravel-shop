<template>
    <div class="container">
        <loading-view v-if="loading"/>
        <div v-else>
            <van-cell-group v-if="dataList.length">
                <van-cell
                        v-for="(page,index) in dataList"
                        :key="index"
                        :title="page.title"
                        size="large"
                        is-link
                        :to="'/page/detail/'+page.id"
                />
            </van-cell-group>
            <van-empty description="暂无记录" v-else/>
        </div>
        <tab-bar :active-index="2"/>
    </div>
</template>

<script>
    import TabBar from "../common/TabBar";

    export default {
        name: "PageIndex",
        components: {TabBar},
        data() {
            return {
                loading: true,
                dataList: []
            }
        },
        methods: {
            fetchList() {
                this.$get('/page/list').then(response => {
                    this.dataList = response.result.items;
                    this.loading = false;
                });
            }
        },
        mounted() {
            this.fetchList();
        }
    }
</script>

<style scoped>

</style>
