<template>
    <div class="content-block">
        <div class="console-title">
            <h2>订单管理->我的订单</h2>
        </div>
        <section style="margin: 20px 0;">
            <div class="dsxui-form-inline">
                <div class="form-item">
                    <div class="form-item-label">订单编号</div>
                    <el-input size="small" class="w200" clearable v-model="searchFields.order_no"></el-input>
                </div>
                <div class="form-item">
                    <div class="form-item-label">商品名称</div>
                    <el-input size="small" class="w200" clearable v-model="searchFields.title"></el-input>
                </div>
                <div class="form-item">
                    <el-button size="small" type="primary" @click="handleSearch">查询</el-button>
                </div>
            </div>
        </section>
        <section>
            <div class="table-edit-header">
                <el-tabs @tab-click="handleTabClick" value="all">
                    <el-tab-pane label="全部" name="all"></el-tab-pane>
                    <el-tab-pane label="待付款" name="waitPay"></el-tab-pane>
                    <el-tab-pane label="待发货" name="waitSend"></el-tab-pane>
                    <el-tab-pane label="待收货" name="send"></el-tab-pane>
                    <el-tab-pane label="待评价" name="waitRate"></el-tab-pane>
                    <el-tab-pane label="已取消" name="closed"></el-tab-pane>
                </el-tabs>
            </div>
            <div class="order-list">
                <table class="order-table">
                    <colgroup>
                        <col>
                        <col width="100">
                        <col width="70">
                        <col width="100">
                        <col width="120">
                        <col width="110">
                        <col width="105">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>宝贝</th>
                        <th class="align-center">单价</th>
                        <th class="align-center">数量</th>
                        <th class="align-center">商品操作</th>
                        <th class="align-center">实付款</th>
                        <th class="align-center">交易状态</th>
                        <th class="align-center">交易操作</th>
                    </tr>
                    </thead>
                </table>

                <el-container style="flex-direction: column;" v-loading="loading">
                    <el-checkbox-group v-model="selectionIds">
                        <div v-for="(order,index) in orderList" :key="index">
                            <table class="order-table">
                                <colgroup>
                                    <col>
                                    <col width="100">
                                    <col width="70">
                                    <col width="100">
                                    <col width="120">
                                    <col width="110">
                                    <col width="105">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th colspan="3">
                                        <div class="display-flex align-items-center">
                                            <div class="col-order-time">{{order.created_at}}</div>
                                            <div class="col-order-no">订单号:{{order.order_no}}</div>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
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
                                        <div class="align-center">￥{{item.price}}</div>
                                    </td>
                                    <td>
                                        <div class="align-center">x{{item.quantity}}</div>
                                    </td>
                                    <td>
                                        <div class="align-center" v-if="order.pay_state&&order.closed===0">
                                            <p><a @click="handleRefund(item)">退款/退货</a></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="align-center" v-if="idx===0">
                                            <p><strong class="font-14">￥{{order.order_fee}}</strong></p>
                                            <p class="col-freight">(含运费:￥{{order.shipping_fee}})</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="align-center" v-if="idx===0">
                                            <p>{{order.buyer_state_des}}</p>
                                            <router-link :to="'/bought/detail?order_id='+order.order_id">订单详情</router-link>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="align-center" v-if="idx===0">
                                            <template v-if="order.order_state===1">
                                                <a :href="'/order/pay?order_id='+order.order_id" target="_blank">
                                                    <el-button size="mini" type="primary">立即支付</el-button>
                                                </a>
                                                <p class="ac-link">
                                                    <a @click="handleShowCancel(order)">取消订单</a>
                                                </p>
                                            </template>

                                            <el-button size="mini"
                                                       type="primary"
                                                       v-if="order.order_state===2"
                                                       @click="handleNotice(order.order_id)"
                                            >提醒发货
                                            </el-button>
                                            <router-link :to="'/bought/detail?order_id='+order.order_id"
                                                         v-if="order.order_state===3">
                                                <el-button size="mini" type="primary">确认收货</el-button>
                                            </router-link>
                                            <router-link :to="'/bought/rate?order_id='+order.order_id"
                                                         v-if="order.order_state===4&&!order.buyer_rate">
                                                <el-button size="mini" type="primary">立即评价</el-button>
                                            </router-link>
                                            <p class="ac-link" v-if="order.closed">
                                                <a @click="handleDelete(order)">删除订单</a>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </el-checkbox-group>
                </el-container>
            </div>
            <div class="table-edit-footer">
                <div class="flex"></div>
                <el-pagination
                        background
                        layout="prev, pager, next, total"
                        :total="total"
                        :page-size="pageSize"
                        @current-change="handlePageChange"
                >
                </el-pagination>
            </div>
        </section>
        <el-dialog title="取消订单" width="450px" :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <tbody>
                <tr>
                    <td>取消原因</td>
                    <td>
                        <el-select size="medium" class="w300" v-model="reason">
                            <el-option
                                    v-for="(reason,index) in closeReasons"
                                    :key="index"
                                    :label="reason"
                                    :value="reason"
                            />
                        </el-select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <el-button size="medium" @click="showDialog=false">取消</el-button>
                        <el-button size="medium" type="primary" @click="handleCloseOrder">确定</el-button>
                    </td>
                </tr>
                </tbody>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "BoughtList",
        data() {
            return {
                orderList: [],
                total: 0,
                offset: 0,
                pageSize: 10,
                selectionIds: [],
                searchFields: {
                    order_no: '',
                    buyer_name: '',
                    tab: 'all'
                },
                loading: true,
                closeReasons: [],
                order: {},
                reason: null,
                showDialog: false
            }
        },
        mounted() {
            this.fetchList();
            this.$get('/order/closereasons').then(response => {
                this.closeReasons = response.result.items;
            });
        },
        methods: {
            fetchList() {
                this.loading = true;
                this.$get('/bought/batchget', {
                    ...this.searchFields,
                    offset: this.offset,
                    count: 10
                }).then(response => {
                    this.orderList = response.result.items;
                    this.total = response.result.total;
                    this.loading = false;
                });
            },
            handleDelete(order) {
                const {order_id} = order;
                this.$confirm('确认要删除此订单吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.loading = true;
                    this.$axios.post('/bought/delete', {order_id}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch() {
                this.offset = 0;
                this.fetchList();
            },
            handleTabClick(tab) {
                this.searchFields.tab = tab.name;
                this.fetchList();
            },
            handleNotice(order_id) {
                this.$post('/bought/notice', {order_id}).then(response => {
                    this.$showToast('已成功提醒卖家发货');
                });
            },
            handleCloseOrder() {
                const {order_id} = this.order;
                if (!this.reason) {
                    this.$showToast('请选择取消原因');
                    return false;
                }
                this.loading = true;
                this.showDialog = false;
                this.$axios.post('/bought/close', {
                    order_id,
                    reason: this.reason
                }).then(response => {
                    this.reason = '';
                    this.fetchList();
                });
            },
            handleRefund(item) {
                const {order_id, sub_order_id, refund_id} = item;
                if (refund_id) {
                    this.$router.push({path: '/refund/detail', query: {refund_id}});
                } else {
                    this.$router.push({path: '/refund/apply', query: {order_id, sub_order_id}});
                }
            },
            handleShowCancel(o) {
                this.order = o;
                this.showDialog = true;
            }
        }
    }
</script>

<style scoped>

</style>
