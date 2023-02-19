<template>
    <div>
        <header class="page-header">
            <div class="page-title">订单管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">订单编号</div>
                        <el-input size="medium" class="w200" v-model="params.order_no"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">买家账号</div>
                        <el-input size="medium" class="w200" v-model="params.buyer_name"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">商品名称</div>
                        <el-input size="medium" class="w200" v-model="params.title"></el-input>
                    </div>
                    <div class="form-item">
                        <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                    </div>
                </div>
            </div>
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="等待付款" name="waitPay"></el-tab-pane>
                        <el-tab-pane label="等待发货" name="waitSend"></el-tab-pane>
                        <el-tab-pane label="已发货" name="send"></el-tab-pane>
                        <el-tab-pane label="交易成功" name="completed"></el-tab-pane>
                        <el-tab-pane label="已关闭" name="closed"></el-tab-pane>
                    </el-tabs>
                </div>
                <div class="order-list">
                    <table class="order-table">
                        <colgroup>
                            <col>
                            <col width="100">
                            <col width="70">
                            <col width="145">
                            <col width="120">
                            <col width="105">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>宝贝</th>
                            <th class="align-center">单价</th>
                            <th class="align-center">数量</th>
                            <th class="align-center">实付款</th>
                            <th class="align-center">交易状态</th>
                            <th class="align-center">交易操作</th>
                        </tr>
                        </thead>
                    </table>

                    <el-container style="flex-direction: column;" v-loading="loading">
                        <el-checkbox-group v-model="selectionIds">
                            <div v-for="(order,index) in dataList" :key="index">
                                <table class="order-table">
                                    <colgroup>
                                        <col>
                                        <col width="100">
                                        <col width="70">
                                        <col width="145">
                                        <col width="120">
                                        <col width="105">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th colspan="2">
                                            <div class="display-flex">
                                                <div class="col-checkbox">
                                                    <el-checkbox :label="order.order_id">{{''}}</el-checkbox>
                                                </div>
                                                <div class="col-order-time">{{order.created_at}}</div>
                                                <div class="col-order-no">订单号:{{order.order_no}}</div>
                                                <div class="col-order-buyer">
                                                    <i class="iconfont icon-peoplefill"></i>
                                                    <span>{{order.buyer_name}}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th colspan="3" class="align-right">{{order.shop_name}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item,idx) in order.items">
                                        <td>
                                            <div class="order-item">
                                                <img :src="item.image" class="thumb" alt="">
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
                                                <p><strong>￥{{order.order_fee}}</strong></p>
                                                <p class="col-freight">(含运费: ￥{{order.shipping_fee}})</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-center" v-if="idx===0">
                                                <p>{{order.state_des}}</p>
                                                <router-link :to="'/order/detail/'+order.order_id"
                                                             target="_blank">订单详情
                                                </router-link>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-center" v-if="idx===0">
                                                <router-link :to="'/order/detail?order_id='+order.order_id"
                                                             v-if="order.order_state===1" target="_blank">
                                                    <el-button size="mini" type="primary">发货</el-button>
                                                </router-link>
                                                <p v-if="order.order_state===20">
                                                    <a class="ac-link" @click="onDeleteOne(order.order_id)">删除订单</a>
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
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            :current-page="page"
                            @current-change="onPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "OrderList",
        mixins: [PaginationMixin],
        data() {
            return {
                params: {
                    order_no: '',
                    buyer_name: '',
                    tab: 'all'
                },
                listApi: '/trade/order.list'
            }
        },

        methods: {
            onDelete() {
                this.$confirm('此操作将永久删除所选订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/trade/order.batchDelete', {ids: this.selectionIds}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onDeleteOne(order_id) {
                this.$confirm('此操作将永久删除所选订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/trade/order.batchDelete', {ids: [order_id]}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.tab = tab.name;
                this.onSearch();
            },
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
