<template>
    <div class="wallet">
        <div class="wallet-summary">
            <div class="flex-fill flex-column justify-content-center">
                <div>
                    账户余额:{{account.balance}},
                    备用金:{{account.freeze}}
                </div>
            </div>
            <div>
                <router-link to="/transfer">
                    <van-button size="small" round>转账</van-button>
                </router-link>
            </div>
        </div>
        <van-sticky>
            <van-tabs :ellipsis="false" border v-model="params.type" @change="onTabChange">
                <van-tab title="收入" name="1"/>
                <van-tab title="支出" name="2"/>
            </van-tabs>
        </van-sticky>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-list @load="onLoadMore" :finished="finished" v-model="loadingMore">
                <div class="van-pull-refresh-body">
                    <van-cell-group v-if="dataList.length">
                        <van-cell
                                v-for="(item,index) in dataList"
                                :title="item.detail"
                                :label="item.created_at"
                                :key="index"
                                title-class="cell-title"
                                label-class="cell-label"
                                value-class="cell-value"
                        >
                            <div class="wallet-amount">{{item.type===1 ? '+' : '-'}}{{item.amount}}</div>
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
        name: "Wallet",
        mixins: [ListMixin],
        data() {
            return {
                account: {},
                type: 1,
                listApi: '/user/bill.list',
                params: {
                    type: 1
                }
            }
        },
        methods: {
            onTabChange() {
                this.onSearch();
            }
        },
        mounted() {
            this.$get('/user/account').then(response => {
                this.account = response.result.account;
            });
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
