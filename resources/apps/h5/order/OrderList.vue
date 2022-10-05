<template>
    <div class="container">
        <van-tabs :ellipsis="false" :sticky="true" v-model="tab" @change="handleTabChange">
            <van-tab title="全部" name="all"/>
            <van-tab title="待发货" name="waitSend"/>
            <van-tab title="待收货" name="waitConfirm"/>
            <van-tab title="已完成" name="waitRate"/>
            <van-tab title="已关闭" name="waitPay"/>
        </van-tabs>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <div class="order-list" v-if="orders.length>0">
                <div class="order-wrapper" v-for="(order,index) in orders" :key="index">
                    <div class="order-head">
                        <div class="flex">单号:{{order.order_no}}</div>
                        <div style="color: #ff6034;">{{order.buyer_state_des}}</div>
                    </div>
                    <router-link :to="'/order/detail?order_id='+order.order_id">
                        <div class="order-items">
                            <div class="item" v-for="(item,index) in order.items" :key="index">
                                <div class="pic-box">
                                    <img :src="item.thumb" class="pic" alt="">
                                </div>
                                <div class="item-center">
                                    <div class="title">{{item.title}}</div>
                                    <div class="sku-title" v-if="item.sku_title">{{item.sku_title}}</div>
                                </div>
                                <div class="item-right">
                                    <p>￥{{item.price}}</p>
                                    <i>x{{item.quantity}}</i>
                                </div>
                            </div>
                        </div>
                    </router-link>
                    <div class="order-row">
                        总价￥{{order.total_fee}}，优惠￥{{order.discount_fee}}，实付款￥{{order.order_fee}}
                    </div>
                    <order-edit-bar
                            :order="order"
                            :reasons="reasons"
                            @cancel="onCancel"
                            @pay="onPay"
                            @delete="onDelete(index)"
                            @confirm="onConfirm"
                    ></order-edit-bar>
                </div>
            </div>
            <div class="no-order" v-else>
                <span class="iconfont icon-form_light"></span>
                <p>没有订单信息</p>
            </div>
        </van-pull-refresh>
    </div>
</template>

<script>
    import OrderEditBar from "../common/OrderEditBar";
    import {bindLoadMore} from "../lib/loadmore";

    export default {
        name: "OrderList",
        components: {
            OrderEditBar,
        },
        data() {
            return {
                tab: 'all',
                orders: [],
                offset: 0,
                loading: true,
                refreshing: false,
                loadMore: false,
                loadMoreAble: false,
                reasons: []
            }
        },
        mounted() {
            this.tab = this.$route.query.tab || 'all'
            this.fetchList();
            this.$get('/order/closereason/getall').then(response => {
                this.reasons = response.result.items.map(o => ({name: o}));
            });
            bindLoadMore(this.onLoadMore);
        },
        methods: {
            fetchList() {
                this.$get('/bought/batchget', {
                    tab: this.tab,
                    offset: this.offset
                }).then(response => {
                    //console.log(response.result);
                    if (this.loadMore) {
                        this.orders = this.orders.concat(response.result.items);
                    } else {
                        this.orders = response.result.items;
                    }

                    this.loading = false;
                    this.refreshing = false;
                    this.loadMore = false;
                    this.loadMoreAble = response.result.items.length === 10;
                });
            },
            onCancel() {
                this.loading = true;
                this.fetchList();
            },
            onPay() {
                this.loading = true;
                this.fetchList();
            },
            onDelete(index) {
                this.orders.splice(index, 1);
            },
            onConfirm() {
                this.loading = true;
                this.fetchList();
            },
            handleTabChange() {
                this.offset = 0;
                this.loading = true;
                this.fetchList();
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
