<template>
    <div class="container">
        <div class="order-list">
            <div class="order-item" v-for="order in orderList" :key="order.order_id">
                <div class="order-item-top">
                    <div class="flex">单号:{{order.order_no}}</div>
                    <div style="color: #ff6034;">{{order.order_state_des}}</div>
                </div>
                <a :href="'/h5/bought/detail?order_id='+order.order_id">
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
                </a>
                <div class="order-action-cell">
                    合计:{{order.total_fee}}(含运费:{{order.shipping_fee}})
                </div>
                <action-tool-bar
                        :order="order"
                        @cancel="onCancel"
                        @pay="onPay(order)"
                ></action-tool-bar>
            </div>
        </div>
    </div>
</template>

<script>
    import ActionToolBar from "../ActionToolBar";

    export default {
        name: "Bought",
        components: {
            ActionToolBar
        },
        data: function () {
            return {
                orderList: []
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/h5/bought/batchget?tab='+tab).then(response => {
                    //console.log(response.data);
                    this.orderList = response.data.items;
                });
            },
            onCancel:function(order){
                console.log('onCancel');
                this.orderList = this.orderList.filter((o,i)=>{
                    return o.order_id != order.order_id;
                });
            },
            onPay: function (order) {
                this.orderList.forEach((o, i) => {
                    if (o.order_id === order.order_id) {
                        o.order_state = 2;
                        o.pay_state = 1;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
