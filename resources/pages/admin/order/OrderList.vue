<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>订单管理</el-breadcrumb-item>
                    <el-breadcrumb-item>订单列表</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="form-inline">
                    <el-form :inline="true">
                        <el-form-item label="订单编号">
                            <el-input size="medium" class="w150" v-model="searchFields.order_no"></el-input>
                        </el-form-item>
                        <el-form-item label="买家账号">
                            <el-input size="medium" class="w150" v-model="searchFields.buyer_name"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button size="medium" type="primary" @click="handleSearch">查询</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="等待买家付款" name="waitPay"></el-tab-pane>
                        <el-tab-pane label="等待发货" name="waitSend"></el-tab-pane>
                        <el-tab-pane label="已发货" name="send"></el-tab-pane>
                        <el-tab-pane label="退款中" name="refunding"></el-tab-pane>
                        <el-tab-pane label="交易成功" name="success"></el-tab-pane>
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

                    <div v-for="(order,index) in orderList" :key="index">
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
                                <th>
                                    <div class="display-flex">
                                        <div class="col-checkbox">
                                            <el-checkbox></el-checkbox>
                                        </div>
                                        <div class="col-order-time">{{order.created_at}}</div>
                                        <div>订单号:{{order.order_no}}</div>
                                    </div>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="align-right">
                                    <span class="iconfont icon-delete_light font-16;" style="cursor: pointer;"></span>
                                </th>
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
                                    <div class="align-center" v-if="idx===0">
                                        <p><strong>￥{{order.total_fee}}</strong></p>
                                        <p class="col-freight">(含运费: ￥{{order.shipping_fee}})</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="align-center" v-if="idx===0">
                                        <p>{{order.seller_state_des}}</p>
                                        <router-link :to="'/order/detail/'+order.order_id">详情</router-link>
                                    </div>
                                </td>
                                <td>
                                    <div class="align-center" v-if="idx===0">
                                        <router-link :to="'/order/detail/'+order.order_id" v-if="order.order_state===2">
                                            <el-button size="mini" type="primary">发货</el-button>
                                        </router-link>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            @current-change="handlerPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "OrderList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                orderList: [],
                total: 0,
                offset: 0,
                pageSize: 10,
                selectionIds: [],
                searchFields: {
                    order_no: '',
                    buyer_name: '',
                    tab:'all'
                }
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/webapi/sold/batchget', {
                    ...this.searchFields,
                    offset: this.offset
                }).then(response => {
                    this.orderList = response.data.items;
                });
            },
            handleSelectionChange: function (val) {
                this.selectionIds = val;
            },
            handleDelete: function () {
                var items = this.selectionIds.map((d) => d.order_id);
                this.$confirm('此操作将永久删除所选订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/webapi/sold/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * this.pagesize;
                this.fetchList();
            },
            handleSearch: function () {
                this.fetchList();
            },
            handleTabClick: function (tab) {
                this.searchFields.tab = tab.name;
                this.fetchList();
            },
        }
    }
</script>

<style scoped>

</style>
