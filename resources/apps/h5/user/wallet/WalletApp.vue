<template>
    <div class="wallet">
        <div class="wallet-summary">
            <div class="flex-fill">
                账户余额:{{account.balance}},
                备用金:{{account.freeze}}
            </div>
            <div>
                <router-link to="/transfer">
                    <van-button size="small" round>转账</van-button>
                </router-link>
            </div>
        </div>
        <van-tabs :ellipsis="false" :sticky="true" v-model="type" @change="handleTabChange">
            <van-tab title="收入" name="1"/>
            <van-tab title="支出" name="2"/>
        </van-tabs>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-cell-group>
                <van-cell
                        v-for="(item,index) in items"
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
        </van-pull-refresh>
    </div>
</template>

<script>
    import {bindLoadMore} from "../../lib/loadmore";
    import ListMixin from "../../lib/ListMixin";

    export default {
        name: "WalletApp",
        mixins: [ListMixin],
        data() {
            return {
                account: {},
                items: [],
                type: 1
            }
        },
        mounted() {
            this.$get('/user/account').then(response => {
                this.account = response.result.account;
            });
            this.fetchList();
            bindLoadMore(this.onLoadMore);
        },
        methods: {
            fetchList() {
                const type = this.type;
                const offset = this.offset;
                const count = this.pageSize;
                this.$get('/user/bill.list', {type, offset, count}).then(response => {
                    let {items} = response.result;
                    if (this.loadMore) {
                        this.items = this.items.concat(items);
                    } else {
                        this.items = items;
                    }
                    this.endLoad(items);
                });
            },
            handleTabChange() {
                this.offset = 0;
                this.refreshing = true;
                this.items = [];
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
