<template>
    <div class="content-block">
        <div class="console-title">
            <h2>订单管理->订单详情</h2>
        </div>
        <section>
            <div class="edit-title">
                <strong>订单信息</strong>
            </div>
            <table class="order-table">
                <thead>
                <tr>
                    <th>宝贝</th>
                    <th class="align-center">单价</th>
                    <th class="align-center">数量</th>
                    <th class="align-center">优惠</th>
                    <th class="align-center">实付款</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,idx) in order.items">
                    <td>
                        <div class="order-item">
                            <img :src="item.thumb" class="thumb" style="width: 60px; height: 60px;" alt="">
                            <div class="flex">
                                <div class="title">{{item.title}}</div>
                                <div class="sku">{{item.sku_title}}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="align-center">￥{{item.price}}</div>
                    </td>
                    <td>
                        <div class="align-center">x{{item.quantity}}</div>
                    </td>
                    <td>
                        <div class="align-center" v-if="idx===0">
                            <p>-￥{{order.discount_fee}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="align-center" v-if="idx===0">
                            <p><strong>￥{{order.order_fee}}</strong></p>
                            <p class="col-freight">(含运费: ￥{{order.shipping_fee}})</p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="dsxui-formtable">
                <colgroup>
                    <col width="80">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">订单编号</td>
                    <td>{{order.order_no}}</td>
                </tr>
                <tr>
                    <td class="cell-label">创建时间</td>
                    <td>{{order.created_at}}</td>
                </tr>
                <tr>
                    <td class="cell-label">订单状态</td>
                    <td>{{order.buyer_state_des}}</td>
                </tr>
                <tr>
                    <td class="cell-label">付款状态</td>
                    <td>{{order.pay_state_des}}</td>
                </tr>
                <tr v-if="order.pay_state">
                    <td class="cell-label">付款时间</td>
                    <td>{{order.pay_at}}</td>
                </tr>
                <tr>
                    <td class="cell-label">收货信息</td>
                    <td>{{shipping.full_address}} {{shipping.name}} {{shipping.tel}}</td>
                </tr>
                </tbody>
            </table>

            <template v-if="order.pay_state&&transaction">
                <div class="edit-title">
                    <strong>付款信息</strong>
                </div>
                <table class="dsxui-formtable" v-if="transaction.pay_type==='wechatpay'">
                    <colgroup>
                        <col width="80">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="cell-label">付款方式</td>
                        <td>{{transaction.pay_type_des}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">交易流水</td>
                        <td>{{transaction.extra.transaction_id}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">付款金额</td>
                        <td>{{(transaction.extra.total_fee)/100}}元</td>
                    </tr>
                    <tr v-if="transaction.pay_state">
                        <td class="cell-label">商户单号</td>
                        <td>{{transaction.extra.out_trade_no}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="dsxui-formtable" v-else>
                    <colgroup>
                        <col width="80">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="cell-label">付款方式</td>
                        <td>{{transaction.pay_type_des}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">交易流水</td>
                        <td>{{transaction.extra.trade_no}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">付款金额</td>
                        <td>{{transaction.extra.total_amount}}元</td>
                    </tr>
                    <tr v-if="transaction.pay_state">
                        <td class="cell-label">商户单号</td>
                        <td>{{transaction.extra.out_trade_no}}</td>
                    </tr>
                    </tbody>
                </table>
            </template>

            <template v-if="order.order_state===3">
                <div class="edit-title">
                    <strong>确认收货</strong>
                </div>
                <table class="dsxui-formtable">
                    <colgroup>
                        <col width="80">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="cell-label">登录密码</td>
                        <td>
                            <el-input size="small" type="password" class="w200" v-model="password"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <el-button size="small" class="w100" type="primary" @click="handleConfirm"
                                       :disabled="!password">确定
                            </el-button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </template>
        </section>
    </div>
</template>

<script>
    export default {
        name: "BoughtDetail",
        data() {
            return {
                order_id: 0,
                order: {},
                shipping: {},
                transaction: {},
                items: [],
                buyer: {},
                item: {},
                password: ''
            }
        },
        mounted() {
            this.order_id = this.$route.query.order_id;
            this.fetchData();
        },
        methods: {
            fetchData() {
                const order_id = this.order_id;
                this.$get('/bought/get', {order_id}).then(response => {
                    this.order = response.result.order;
                    const {shipping, transaction, items, buyer} = response.result.order;
                    this.shipping = shipping;
                    this.transaction = transaction;
                    this.items = items;
                    this.buyer = buyer;
                });
            },
            handleConfirm() {
                this.$post('/bought/confirm', {
                    order_id: this.order_id,
                    password: this.password
                }).then(response => {
                    if (response.result.errcode) {
                        this.$showToast(response.result.errmsg);
                    } else {
                        this.$router.go(0);
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
