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
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">订单编号</div>
                        <el-input size="medium" class="w200" v-model="searchFields.order_no"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">买家账号</div>
                        <el-input size="medium" class="w200" v-model="searchFields.buyer_name"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">商品名称</div>
                        <el-input size="medium" class="w200" v-model="searchFields.title"></el-input>
                    </div>
                    <div class="form-item">
                        <el-button size="medium" type="primary" @click="handleSearch">查询</el-button>
                    </div>
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

                    <el-container style="flex-direction: column;" v-loading="loading">
                        <el-checkbox-group v-model="selectionIds">
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
                                                    <el-checkbox :label="order.order_id">{{''}}</el-checkbox>
                                                </div>
                                                <div class="col-order-time">{{order.created_at}}</div>
                                                <div class="col-order-no">订单号:{{order.order_no}}</div>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="align-right">

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
                                                <router-link :to="'/order/detail/'+order.order_id"
                                                             v-if="order.order_state===2">
                                                    <el-button size="mini" type="primary">发货</el-button>
                                                </router-link>
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
                    tab: 'all'
                },
                loading: true
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.loading = true;
                this.$get('/admin/order/batchget', {
                    ...this.searchFields,
                    offset: this.offset,
                    count: 10
                }).then(response => {
                    this.orderList = response.data.items;
                    this.total = response.data.total;
                    this.loading = false;
                });
            },
            handleDelete: function () {
                this.$confirm('此操作将永久删除所选订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.loading = true;
                    this.$axios.post('/admin/order/delete', {items: this.selectionIds}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * this.pageSize;
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
