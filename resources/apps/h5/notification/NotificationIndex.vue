<template>
    <div class="container">
        <loading-view v-if="loading"/>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh" v-else>
            <div class="van-pull-refresh-body">
                <div v-if="dataList.length">
                    <van-swipe-cell v-for="(notify,index) in dataList" :key="index">
                        <van-cell size="large">
                            <div slot="title">{{notify.data.title}}</div>
                            <div slot="label">
                                <div>{{notify.data.message}}</div>
                                <div style="font-size: 12px; margin-top: 5px;">{{notify.created_at}}</div>
                            </div>
                        </van-cell>
                        <div slot="right" class="van-swipe-cell-delete-slot" @click="onDelete(index)">
                            <span>删除</span>
                        </div>
                    </van-swipe-cell>
                </div>
                <van-empty description="暂无消息" v-else/>
            </div>
        </van-pull-refresh>
        <tab-bar :active-index="2"/>
    </div>
</template>

<script>
    import TabBar from "../common/TabBar";
    import ListMixin from "../lib/ListMixin";

    export default {
        name: "NotificationIndex",
        components: {TabBar},
        mixins: [ListMixin],
        data() {
            return {
                listApi: '/user/notification'
            }
        },
        methods: {
            onDelete(index) {
                let {id} = this.dataList[index];
                this.$post('/user/notification.delete', {id}).then(() => {
                    this.dataList.splice(index, 1);
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
