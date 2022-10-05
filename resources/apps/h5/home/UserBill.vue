<template>
    <div class="container">
        <van-tabs :ellipsis="false" :sticky="true" v-model="type" @change="handleTabChange">
            <van-tab title="收入" name="1"/>
            <van-tab title="支出" name="2"/>
        </van-tabs>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-cell
                    v-for="(item,index) in items"
                    :key="index"
                    :title="item.detail"
                    :label="item.created_at"
            >
                <span class="amount">{{item.type===1 ? '+' : '-'}}{{item.amount}}</span>
            </van-cell>
        </van-pull-refresh>
    </div>
</template>

<script>
    import ListMixin from "../lib/ListMixin";
    import {bindLoadMore} from "../lib/loadmore";

    export default {
        name: "UserBill",
        mixins: [ListMixin],
        data() {
            return {
                items: [],
                type: 1
            }
        },
        methods: {
            fetchList() {
                this.$get('/user/bill.list', {
                    type: this.type,
                    offset: this.offset,
                    count: this.pageSize
                }).then(response => {
                    let {items} = response.result;
                    if (this.loadMore) {
                        this.items = this.items.concat(items);
                    } else {
                        this.items = items;
                    }
                });
            },
            handleTabChange() {
                this.offset = 0;
                this.loading = true;
                this.fetchList();
            }
        },
        mounted() {
            this.fetchList();
            bindLoadMore(this.onLoadMore);
        }
    }
</script>

<style scoped>
    .amount {
        color: #0b2e13;
        margin-left: 10px;
    }
</style>
