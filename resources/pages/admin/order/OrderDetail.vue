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
                    <span>收货信息</span>
                </div>
                <table class="dsxui-formtable">
                    <colgroup>
                        <col width="80">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="cell-label">买家账号</td>
                        <td>{{buyer.username}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">收货人</td>
                        <td>{{shipping.name}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">联系电话</td>
                        <td>{{shipping.tel}}</td>
                    </tr>
                    <tr>
                        <td class="cell-label">收货地址</td>
                        <td>{{shipping.full_address}}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="edit-title">
                    <span>订单信息</span>
                </div>
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
                    </tbody>
                </table>

                <template v-if="order.pay_state&&transaction">
                    <div class="edit-title">
                        <span>付款信息</span>
                    </div>
                    <table class="dsxui-formtable">
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
                            <td class="cell-label">付款单号</td>
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
                </template>

                <div class="edit-title">
                    <span>商品信息</span>
                </div>
                <table class="order-table">
                    <thead>
                    <tr>
                        <th>宝贝</th>
                        <th></th>
                        <th class="align-center">单价</th>
                        <th class="align-center">数量</th>
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
                        <td>
                            <p v-if="order.order_state===1">
                                <a style="color: #0b90ef;" @click="handleShowEdit(item)">修改价格</a>
                            </p>
                        </td>
                        <td>
                            <div class="align-center">￥{{item.price}}</div>
                        </td>
                        <td>
                            <div class="align-center">x{{item.quantity}}</div>
                        </td>
                        <td>
                            <div class="align-center" v-if="idx===0">
                                <p><strong>￥{{order.total_fee}}</strong></p>
                                <p class="col-freight">(含运费: ￥{{order.shipping_fee}})</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

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
        <el-dialog :visible.sync="showDialog" width="35%" title="修改商品价格">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w80">
                    <col class="w200">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">商品名称</td>
                    <td class="cell-input" colspan="2">
                        {{item.title}}
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">商品单价</td>
                    <td class="cell-input">
                        <el-input type="number" v-model="item.price" size="medium"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">商品数量</td>
                    <td class="cell-input">
                        <el-input type="number" v-model="item.quantity" size="medium"></el-input>
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
        data: function () {
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
                item: {}
            }
        },
        mounted() {
            this.order_id = this.$route.params.order_id;
            this.getOrder();
            this.fetchExpress();
        },
        methods: {
            getOrder: function () {
                this.$get('/admin/order/get?order_id=' + this.order_id).then(response => {
                    this.order = response.data.order;
                    const {shipping, transaction, items, buyer} = response.data.order;
                    this.shipping = shipping;
                    this.transaction = transaction;
                    this.items = items;
                    this.buyer = buyer;
                });
            },
            fetchExpress: function () {
                this.$get('/admin/express/getall').then(response => {
                    this.expresses = response.data.items;
                });
            },
            handleChange: function (val) {
                //console.log(val);
                this.express.express_name = val.name;
                this.express.express_code = val.code;
            },
            handleSubmit: function () {
                //console.log(this.express);
                if (!this.express.express_code) {
                    this.$showToast('请选择快递公司');
                    return false;
                }

                if (!this.express.express_no) {
                    this.$showToast('请填写快递单号');
                    return false;
                }

                this.$post('/admin/order/send', {
                    order_id: this.order_id,
                    express: this.express
                }).then(response => {
                    this.$showToast('发货成功');
                    this.getOrder();
                });
            },
            handleShowEdit(item) {
                this.item = item;
                this.showDialog = true;
            },
            handleSavePrice() {
                if (!this.item.price) {
                    this.$showToast('请填写价格');
                    return false;
                }

                if (!this.item.quantity) {
                    this.$showToast('请填写数量');
                    return false;
                }

                this.showDialog = false;
                const {id, price, quantity} = this.item;
                this.$post('/admin/order/editprice', {id, price, quantity}).then(response => {
                    this.getOrder();
                });
            }
        }
    }
</script>

<style scoped>

</style>
