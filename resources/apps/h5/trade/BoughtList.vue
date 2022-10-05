<template>
    <div class="container">
        <van-sticky>
            <van-tabs :ellipsis="false" :border="true" v-model="params.tab" @change="onTabChange">
                <van-tab title="全部" name="all"/>
                <van-tab title="待发货" name="waitSend"/>
                <van-tab title="待收货" name="waitConfirm"/>
                <van-tab title="已完成" name="completed"/>
                <van-tab title="已关闭" name="closed"/>
            </van-tabs>
        </van-sticky>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-list
                    @load="onLoadMore"
                    v-model="loadingMore"
                    :finished="finished"
                    v-if="dataList.length>0"
            >
                <div class="order-list">
                    <div class="order-item" v-for="(order,index) in dataList" :key="index">
                        <div class="order-head">
                            <div class="flex">单号:{{order.order_no}}</div>
                            <div style="color: #ff6034;">{{order.state_des}}</div>
                        </div>
                        <router-link :to="'/bought/detail/'+order.order_id">
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
                        <order-action-bar
                                :order="order"
                                @cancel="onCancel"
                                @pay="onPay"
                                @delete="onDelete(index)"
                                @confirm="onConfirm"
                        ></order-action-bar>
                    </div>
                </div>
            </van-list>
            <div class="order-empty" v-else>
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
        <order-cancel-pannel :order="order" v-model="showCancel" @confirm="fetchList"/>
    </div>
</template>

<script>
    import PasswordPannel from "./PasswordPannel";
    import ListMixin from "../lib/ListMixin";
    import OrderActionBar from "./components/OrderActionBar";
    import OrderCancelPannel from "./components/OrderCancelPannel";

    export default {
        name: "BoughtList",
        components: {
            OrderCancelPannel,
            OrderActionBar,
            PasswordPannel
        },
        mixins: [ListMixin],
        data() {
            return {
                order: {},
                params: {tab: 'all'},
                showPannel: false,
                showCancel: false,
                listApi: '/trade/bought.list',
                pageSize: 10
            }
        },
        methods: {
            onCancel(order) {
                this.order = order;
                this.showCancel = true;
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
                this.dataList.splice(index, 1);
            },
            onConfirm() {
                this.loading = true;
                this.fetchList();
            },
            onTabChange() {
                this.onSearch();
            }
        },
        mounted() {
            this.tab = this.$route.query.tab;
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
