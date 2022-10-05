<template>
    <loading-view v-if="loading"/>
    <div class="container" v-else>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-list @load="onLoadMore" v-model="loadingMore" :finished="finished">
                <div class="van-pull-refresh-body">
                    <van-cell-group v-if="dataList.length">
                        <van-cell
                                v-for="(su,index) in dataList"
                                :key="index"
                                size="large"
                                center
                                is-link
                        >
                            <div slot="icon" class="van-cell-icon-slot">
                                <van-image :src="su.avatar" width="40" height="40" round/>
                            </div>
                            <div slot="title">{{su.username}}</div>
                            <div slot="label">积分:{{su.credits}}</div>
                        </van-cell>
                    </van-cell-group>
                    <van-empty description="暂无记录" v-else/>
                </div>
            </van-list>
        </van-pull-refresh>
    </div>
</template>

<script>
    import ListMixin from "../lib/ListMixin";

    export default {
        name: "Subordinate",
        mixins: [ListMixin],
        data() {
            return {
                listApi: '/user/subuser.list'
            }
        },
        methods: {},
        mounted() {
            this.fetchList();
        }
    }
</script>

<style scoped>

</style>
