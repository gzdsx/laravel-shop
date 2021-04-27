<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>订单管理</el-breadcrumb-item>
                    <el-breadcrumb-item>订单详情</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div>
                <router-link to="/order/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
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
                                <p v-if="order.order_state===1">
                                    <a style="color: #0b90ef;" @click="handleShowEdit(item)">修改价格</a>
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
                        <td>{{order.seller_state_des}}</td>
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
                        <td>{{buyer.username}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">收货信息</td>
                        <td>{{shipping.address}} {{shipping.name}} {{shipping.tel}}</td>
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
                            <td>{{shipping.full_address}} {{shipping.name}} {{shipping.tel}}</td>
                        </tr>
                        <tr>
                            <td class="cell-label">发货时间</td>
                            <td>{{order.shipping_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </template>

                <template v-if="order.order_state===2">
                    <div class="edit-title">
                        <span>发货</span>
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
                                <el-select size="medium" class="w300" v-model="express.express_name"
                                           @change="handleChange">
                                    <el-option
                                            v-for="(exp,index) in expresses"
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
                                <el-button size="medium" type="primary" @click="handleSubmit">发货</el-button>
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
                        <el-button type="primary" size="medium" class="w100" @click="handleSavePrice">确定</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "OrderDetail",
        components: {
            AdminFrame
        },
        data() {
            return {
                order_id: 0,
                order: {},
                shipping: {},
                transaction: {},
                items: [],
                buyer: {},
                expresses: [],
                express: {
                    express_code: '',
                    express_name: '',
                    express_no: ''
                },
                showDialog: false,
                item: {},
                order_fee: 0
            }
        },
        mounted() {
            this.order_id = this.$route.query.order_id;
            this.fetchData();
            this.fetchExpress();
        },
        methods: {
            fetchData() {
                this.$get('/order/get?order_id=' + this.order_id).then(response => {
                    this.order = response.result.order;
                    const {shipping, transaction, items, buyer} = response.result.order;
                    this.shipping = shipping;
                    this.transaction = transaction;
                    this.items = items;
                    this.buyer = buyer;
                    this.order_fee = this.order.order_fee;
                });
            },
            fetchExpress() {
                this.$get('/express/getall').then(response => {
                    this.expresses = response.result.items;
                });
            },
            handleChange(val) {
                //console.log(val);
                this.express.express_name = val.name;
                this.express.express_code = val.code;
            },
            handleSubmit() {
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

                this.$post('/order/send', {
                    order_id: this.order_id,
                    express_code,
                    express_name,
                    express_no
                }).then(response => {
                    this.$showToast('发货成功', () => this.$router.go(0));
                });
            },
            handleShowEdit(item) {
                this.item = item;
                this.showDialog = true;
            },
            handleSavePrice() {
                if (!this.order_fee) {
                    this.$showToast('请填写价格');
                    return false;
                }

                this.showDialog = false;
                const order_id = this.order_id;
                const order_fee = this.order_fee;
                this.$post('/order/adjustprice', {order_id, order_fee}).then(response => {
                    this.$router.go(0);
                });
            }
        }
    }
</script>

<style scoped>

</style>
