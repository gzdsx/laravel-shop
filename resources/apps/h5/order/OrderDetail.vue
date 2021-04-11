<template>
    <div class="container">
        <div class="order-detail">
            <div class="order-state">
                <div class="order-state-text">
                    <span v-if="order.order_state===1">等待付款</span>
                    <span v-if="order.order_state===2">等待卖家发货</span>
                    <span v-if="order.order_state===3">等待确认</span>
                    <span v-if="order.order_state===4">交易完成</span>
                    <span v-if="order.order_state===5">退款中</span>
                    <span v-if="order.order_state===6">交易关闭</span>
                </div>
                <div class="order-state-icon">
                    <span class="iconfont icon-pay" v-if="order.order_state===1"></span>
                    <span class="iconfont icon-send1" v-if="order.order_state===2"></span>
                    <span class="iconfont icon-deliver" v-if="order.order_state===3"></span>
                    <span class="iconfont icon-evaluate" v-if="order.order_state===4"></span>
                    <span class="iconfont icon-refund" v-if="order.order_state===5"></span>
                    <span class="iconfont icon-close-circle" v-if="order.order_state===6"></span>
                </div>
            </div>
            <div class="shipping-address" v-if="order.shipping">
                <div class="shipping-address-icon">
                    <span class="iconfont icon-location"></span>
                </div>
                <div class="flex">
                    <div class="display-flex">
                        <div class="flex">{{order.shipping.name}}</div>
                        <div>{{order.shipping.tel}}</div>
                    </div>
                    <div>
                        {{order.shipping.full_address}}
                    </div>
                </div>
            </div>
            <div class="order-section-title">商品信息</div>
            <div class="order-items">
                <div class="item" v-for="(item,index) in order.items" :key="index">
                    <div class="pic-box">
                        <img :src="item.thumb" alt="" class="pic">
                    </div>
                    <div class="ctx-box">
                        <div class="flex-row">
                            <div class="title-box">
                                <div class="title">{{item.title}}</div>
                                <div class="sku-title">{{item.sku_title}}</div>
                            </div>
                            <div class="right-box">
                                <p>￥{{item.price}}</p>
                                <i>x{{item.quantity}}</i>
                            </div>
                        </div>
                        <div class="flex-fill"></div>
                        <div class="flex-row justify-content-end">
                            <div class="ctx-button" @click="handleAddCart(item)">加入购物车</div>
                            <div class="ctx-button" @click="applyService(item)"
                                 v-if="order.pay_state&&item.refund_state===0">
                                申请售后
                            </div>
                            <a class="ctx-button" :href="'/h5/refund/detail?refund_id='+item.refund_id"
                               v-if="item.refund_state===1">退款中</a>
                            <a class="ctx-button" :href="'/h5/refund/detail?refund_id='+item.refund_id"
                               v-if="item.refund_state===2">退款完成</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-info-cell">
                <div class="cell-title">商品总价</div>
                <div class="cell-value">￥{{order.product_fee}}</div>
            </div>
            <div class="order-info-cell">
                <div class="cell-title">运费</div>
                <div class="cell-value">+￥{{order.shipping_fee}}</div>
            </div>
            <div class="order-info-cell">
                <div class="cell-title">优惠</div>
                <div class="cell-value">-￥{{order.discount_fee}}</div>
            </div>
            <div class="order-info-cell">
                <div class="cell-title">实付款</div>
                <div class="cell-value" style="color: #f40;">￥{{order.order_fee}}</div>
            </div>
            <div class="state-info">
                <div class="order-data-cell">订单编号: {{order.order_no}}</div>
                <div class="order-data-cell">创建时间: {{order.created_at}}</div>
                <div class="order-data-cell">交易流水: {{transaction.out_trade_no}}</div>
                <div class="order-data-cell" v-if="order.pay_state">付款方式: {{transaction.pay_type_des}}</div>
                <div class="order-data-cell" v-if="order.pay_state">付款时间: {{transaction.pay_at}}</div>
                <div class="order-data-cell" v-if="order.receive_state">成交时间: {{order.receive_at}}</div>
            </div>
        </div>

        <div class="h60"></div>
        <div class="bottom-fixed-bar">
            <order-edit-bar
                    :order="order"
                    :reasons="reasons"
                    @pay="onPay"
                    @cancel="onCancel"
                    @confirm="onConfirm"
                    @delete="onDelete"
            />
        </div>
    </div>
</template>

<script>
    import OrderEditBar from "../common/OrderEditBar";

    export default {
        name: "OrderDetail",
        components: {
            OrderEditBar,
        },
        data() {
            return {
                order_id: 0,
                order: {},
                shipping: {},
                transaction: {},
                reasons: []
            }
        },
        mounted() {
            this.$get('/order/closereason/getall').then(response => {
                this.reasons = response.result.items.map(o => ({name: o}));
            });
            this.order_id = this.$route.query.order_id;
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                this.$get('/bought/get?order_id=' + this.order_id).then(response => {
                    this.order = response.result.order;
                    const {shipping, transaction} = this.order;
                    if (shipping) this.shipping = shipping;
                    if (transaction) this.transaction = transaction;
                });
            },
            onCancel() {
                this.fetchData();
            },
            onPay() {
                this.fetchData();
            },
            onConfirm() {
                this.fetchData();
            },
            onDelete() {
                this.$showToast('订单已删除', () => window.location.replace('/h5/order'));
            },
            handleAddCart(item) {
                const {itemid, quantity, sku_id} = item;
                this.$post('/cart/create', {itemid, quantity, sku_id}).then(response => {
                    this.$toast.success('已加成功入购物车');
                });
            },
            applyService(item) {
                const {sub_order_id} = item;
                this.$router.push({path: '/refund/router', query: {sub_order_id}});
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
