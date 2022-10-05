<template>
    <div>
        <header class="page-header">
            <div class="page-title">订单详情</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="edit-title">
                    <strong>订单信息</strong>
                </div>
                <table class="order-table">
                    <thead>
                    <tr>
                        <th>宝贝</th>
                        <th></th>
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
                                <img :src="item.thumb" class="thumb" alt="">
                                <div class="flex">
                                    <div class="title">{{item.title}}</div>
                                    <div class="sku">{{item.sku_title}}</div>
                                </div>
                            </div>
                        </td>
                        <td></td>
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
                                <p v-if="order.order_state===0">
                                    <a style="color: #0b90ef;" @click="onShowEdit(item)">修改价格</a>
                                </p>
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
                        <td>{{order.state_des}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">订单金额</td>
                        <td>{{order.order_fee}}</td>
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
                        <td class="cell-label">买家账号</td>
                        <td>{{order.buyer_name}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">收货信息</td>
                        <td>{{shipping.formatted_address}} {{shipping.name}} {{shipping.phone}}</td>
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
                        </tbody>
                        <tbody v-if="transaction.data">
                        <tr>
                            <td class="cell-label">付款单号</td>
                            <td>{{transaction.data.transaction_id}}</td>
                        </tr>
                        <tr>
                            <td class="cell-label">付款金额</td>
                            <td>{{(transaction.data.total_fee)/100}}元</td>
                        </tr>
                        <tr>
                            <td class="cell-label">商户单号</td>
                            <td>{{transaction.data.out_trade_no}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="dsxui-formtable" v-if="transaction.pay_type==='alipay'">
                        <colgroup>
                            <col width="80">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td class="cell-label">付款方式</td>
                            <td>{{transaction.pay_type_des}}</td>
                        </tr>
                        </tbody>
                        <tbody v-if="transaction.data">
                        <tr>
                            <td class="cell-label">付款单号</td>
                            <td>{{transaction.data.trade_no}}</td>
                        </tr>
                        <tr>
                            <td class="cell-label">付款金额</td>
                            <td>{{(transaction.data.total_amount)}}元</td>
                        </tr>
                        <tr>
                            <td class="cell-label">商户单号</td>
                            <td>{{transaction.data.out_trade_no}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="dsxui-formtable" v-if="transaction.pay_type==='balance'">
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
                            <td>{{transaction.out_trade_no}}</td>
                        </tr>
                        </tbody>
                    </table>
                </template>

                <template v-if="order.shipping_state">
                    <div class="edit-title">
                        <strong>物流信息</strong>
                    </div>
                    <table class="dsxui-formtable">
                        <colgroup>
                            <col width="80">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td class="cell-label">快递公司</td>
                            <td>{{shipping.express_name}}</td>
                        </tr>
                        <tr>
                            <td class="cell-label">快递单号</td>
                            <td>{{shipping.express_no}}</td>
                        </tr>
                        <tr>
                            <td class="cell-label">收货地址</td>
                            <td>{{shipping.formatted_address}} {{shipping.name}} {{shipping.phone}}</td>
                        </tr>
                        <tr>
                            <td class="cell-label">发货时间</td>
                            <td>{{order.shipping_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </template>

                <template v-if="order.order_state===1">
                    <div class="edit-title">
                        <strong>发货</strong>
                    </div>
                    <table class="dsxui-formtable">
                        <colgroup>
                            <col width="80">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td class="cell-label">快递公司</td>
                            <td>
                                <el-select size="medium" class="w300" v-model="express.express_name" @change="onChange">
                                    <el-option
                                            v-for="(exp,index) in expressList"
                                            :label="exp.name"
                                            :value="exp"
                                            :key="index"
                                    >

                                    </el-option>
                                </el-select>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell-label">快递单号</td>
                            <td>
                                <el-input size="medium" class="w300" v-model="express.express_no"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <el-button size="medium" type="primary" @click="onSubmit">发货</el-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </template>
            </div>
        </div>
        <el-dialog :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false" width="35%"
                   title="修改价格">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w120">
                    <col class="w200">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">订单实付金额</td>
                    <td class="cell-input">
                        <el-input type="number" v-model="order_fee" size="medium"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" @click="onSavePrice">确定</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "OrderDetail",
        data() {
            return {
                order: {},
                shipping: {},
                transaction: {},
                expressList: [],
                express: {
                    express_code: '',
                    express_name: '',
                    express_no: ''
                },
                showDialog: false,
                order_fee: 0
            }
        },
        mounted() {
            this.fetchData();
            this.fetchExpressList();
        },
        methods: {
            fetchData() {
                let {order_id} = this.$route.params;
                if (!order_id) return;
                this.$get('/trade/order.info', {order_id}).then(response => {
                    this.order = response.result;
                    const {shipping, transaction, order_fee} = response.result;
                    this.shipping = shipping;
                    this.transaction = transaction;
                    this.order_fee = order_fee;
                });
            },
            fetchExpressList() {
                this.$get('/express/list').then(response => {
                    this.expressList = response.result.items;
                });
            },
            onChange(val) {
                //console.log(val);
                this.express.express_name = val.name;
                this.express.express_code = val.code;
            },
            onSubmit() {
                //console.log(this.express);
                const {express_code, express_no, express_name} = this.express;
                if (!express_code) {
                    this.$showToast('请选择快递公司');
                    return false;
                }

                if (!express_no) {
                    this.$showToast('请填写快递单号');
                    return false;
                }

                let {order_id} = this.order;
                this.$post('/trade/order.send', {
                    order_id,
                    express_code,
                    express_name,
                    express_no
                }).then(() => {
                    this.$showToast('发货成功', this.fetchData);
                });
            },
            onShowEdit() {
                this.showDialog = true;
            },
            onSavePrice() {
                let {order_fee} = this;
                let {order_id} = this.order;
                if (!order_fee) {
                    this.$showToast('请填写价格');
                    return false;
                }

                this.$post('/trade/order.adjustprice', {order_id, order_fee}).then(() => {
                    this.fetchData();
                    this.showDialog = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>
