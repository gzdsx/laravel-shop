<template>
    <div class="container">
        <div class="order-list" v-if="orderList.length>0">
            <div class="order-item" v-for="(order,index) in orderList" :key="order.order_id">
                <div class="order-item-top">
                    <div class="flex">单号:{{order.order_no}}</div>
                    <div style="color: #ff6034;">{{order.buyer_state_des}}</div>
                </div>
                <router-link :to="'/order/detail/'+order.order_id">
                    <div class="goods-item" v-for="(item,index) in order.items" :key="index">
                        <div class="bg-cover goods-image" :style="'background-image: url('+item.thumb+')'"></div>
                        <div class="goods-center">
                            <div class="goods-title">{{item.title}}</div>
                        </div>
                        <div class="goods-right">
                            <p>￥{{item.price}}</p>
                            <i>x{{item.quantity}}</i>
                        </div>
                    </div>
                </router-link>
                <div class="order-action-cell">
                    共{{order.total_count}}件商品,合计:{{order.total_fee}}(含运费:{{order.shipping_fee}})
                </div>
                <order-edit-bar
                        :order="order"
                        @cancel="onCancel"
                        @pay="onPay(order)"
                        @delete="onDelete(index)"
                ></order-edit-bar>
            </div>
        </div>
        <div class="no-order" v-else>
            <span class="iconfont icon-form_light"></span>
            <p>没有订单信息</p>
        </div>
    </div>
</template>

<script>
    import OrderEditBar from "../components/OrderEditBar";

    export default {
        name: "OrderList",
        components: {
            OrderEditBar
        },
        data: function () {
            return {
                orderList: [],
                tab: 'all'
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/bought/batchget?tab=' + this.tab).then(response => {
                    //console.log(response.data);
                    this.orderList = response.data.items;
                });
            },
            onCancel: function (order) {
                this.fetchList();
            },
            onPay: function (order) {
                this.orderList.forEach((o, i) => {
                    if (o.order_id === order.order_id) {
                        o.order_state = 2;
                        o.pay_state = 1;
                    }
                });
            },
            onDelete: function (index) {
                this.orderList.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>
