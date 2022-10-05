<template>
    <div class="container">
        <van-tabs :ellipsis="false" :sticky="true" v-model="tab" @change="handleTabChange">
            <van-tab title="全部" name="all"/>
            <van-tab title="待发货" name="waitSend"/>
            <van-tab title="待收货" name="waitConfirm"/>
            <van-tab title="已完成" name="completed"/>
            <van-tab title="已关闭" name="closed"/>
        </van-tabs>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <div class="order-list" v-if="orders.length>0">
                <div class="order-wrapper" v-for="(order,index) in orders" :key="index">
                    <div class="order-head">
                        <div class="flex">单号:{{order.order_no}}</div>
                        <div style="color: #ff6034;">{{order.state_des}}</div>
                    </div>
                    <router-link :to="'/bought/detail?order_id='+order.order_id">
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
        <password-pannel
                :show="showPannel"
                :order="order"
                @paid="onPaid"
                @close="showPannel=false"
        />
    </div>
</template>

<script>
    import OrderEditBar from "../common/OrderEditBar";
    import PasswordPannel from "./PasswordPannel";
    import {bindLoadMore} from "../lib/loadmore";
    import ListMixin from "../lib/ListMixin";

    export default {
        name: "BoughtList",
        components: {
            OrderEditBar,
            PasswordPannel
        },
        mixins: [ListMixin],
        data() {
            return {
                tab: 'all',
                orders: [],
                reasons: [],
                showPannel: false,
                order: {}
            }
        },
        mounted() {
            this.tab = this.$route.query.tab;
            this.fetchList();
            this.fetchReasons();
            this.setBackgroundColor('#f5f5f5');
            bindLoadMore(this.onLoadMore);
        },
        methods: {
            fetchList() {
                this.$get('/bought/list', {
                    tab: this.tab,
                    offset: this.offset,
                    count: this.pageSize
                }).then(response => {
                    //console.log(response.result);
                    let {items} = response.result;
                    if (this.loadMore) {
                        this.orders = this.orders.concat(items);
                    } else {
                        this.orders = items;
                    }
                    this.endLoad(items);
                });
            },
            fetchReasons() {
                this.$get('/order/closereasons').then(response => {
                    this.reasons = response.result.items.map((o) => {
                        return {
                            name: o
                        };
                    });
                });
            },
            onCancel() {
                this.loading = true;
                this.fetchList();
            },
            onPay(order) {
                //this.loading = true;
                //this.fetchList();
                this.order = order;
                this.showPannel = true;
            },
            onPaid() {
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
            }
        }
    }
</script>

<style scoped>

</style>
