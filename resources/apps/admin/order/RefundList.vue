<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>退款处理</el-breadcrumb-item>
                    <el-breadcrumb-item>申请列表</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="待处理" name="1"></el-tab-pane>
                        <el-tab-pane label="已拒绝" name="2"></el-tab-pane>
                        <el-tab-pane label="已同意" name="3"></el-tab-pane>
                        <el-tab-pane label="已退货" name="4"></el-tab-pane>
                        <el-tab-pane label="已退款" name="5"></el-tab-pane>
                        <el-tab-pane label="已关闭" name="6"></el-tab-pane>
                    </el-tabs>
                </div>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="refund_id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="refund_no" width="200" label="退款编号"></el-table-column>
                    <el-table-column prop="refund_reason" label="退款理由"></el-table-column>
                    <el-table-column prop="refund_type_des" width="140" label="服务类型"></el-table-column>
                    <el-table-column prop="refund_amount" width="120" label="退款金额"></el-table-column>
                    <el-table-column prop="refund_state_des" width="180" label="状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="申请时间"></el-table-column>
                    <el-table-column width="60" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/refund/detail?refund_id='+scope.row.refund_id" target="_blank">详情</router-link>
                        </template>
                    </el-table-column>
                </el-table>
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
                            @current-change="handlePageChange"
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
        name: "RefundList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                items: [],
                total: 0,
                offset: 0,
                pageSize: 15,
                selectionIds: [],
                searchFields: {
                    refund_state:'all'
                },
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList () {
                this.$get('/refund/batchget', {
                    ...this.searchFields,
                    offset: this.offset
                }).then(response => {
                    const {items, total} = response.data;
                    this.total = total;
                    this.items = items;
                });
            },
            handleSelectionChange (val) {
                this.selectionIds = val;
            },
            handleDelete () {
                var items = this.selectionIds.map((d) => d.refund_id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/refund/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlePageChange (page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch: function () {
                this.fetchList();
            },
            handleTabClick (tab) {
                this.searchFields.refund_state = tab.name;
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
