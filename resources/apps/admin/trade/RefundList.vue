<template>
    <div>
        <header class="page-header">
            <div class="page-title">退款管理</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="待处理" name="1"></el-tab-pane>
                        <el-tab-pane label="已拒绝" name="2"></el-tab-pane>
                        <el-tab-pane label="已同意" name="3"></el-tab-pane>
                        <el-tab-pane label="已退货" name="4"></el-tab-pane>
                        <el-tab-pane label="已退款" name="5"></el-tab-pane>
                        <el-tab-pane label="已关闭" name="6"></el-tab-pane>
                    </el-tabs>
                </div>
                <el-table :data="dataList" @selection-change="onSelectionChange">
                    <el-table-column prop="refund_id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="refund_no" width="200" label="退款编号"></el-table-column>
                    <el-table-column prop="refund_reason" label="退款理由"></el-table-column>
                    <el-table-column prop="refund_type_des" width="140" label="服务类型"></el-table-column>
                    <el-table-column prop="refund_amount" width="120" label="退款金额"></el-table-column>
                    <el-table-column prop="refund_state_des" width="180" label="状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="申请时间"></el-table-column>
                    <el-table-column width="60" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/refund/detail/'+scope.row.refund_id" target="_blank">详情
                            </router-link>
                        </template>
                    </el-table-column>
                </el-table>
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
        name: "RefundList",
        mixins:[PaginationMixin],
        data() {
            return {
                params: {
                    refund_state: 'all'
                },
                listApi:'/trade/refund.list'
            }
        },
        methods: {
            onDelete() {
                let ids = this.selectionIds.map((d) => d.refund_id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/trade/refund.batchdelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.refund_state = tab.name;
                this.onSearch();
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
