<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>付款记录</el-breadcrumb-item>
                <el-breadcrumb-item>交易列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="form-inline">
                    <el-form :inline="true">
                        <el-form-item label="交易流水">
                            <el-input size="medium" class="w200" v-model="searchFields.out_trade_no"></el-input>
                        </el-form-item>
                        <el-form-item label="商品名称">
                            <el-input size="medium" class="w200" v-model="searchFields.subject"></el-input>
                        </el-form-item>
                        <el-form-item label="付款方">
                            <el-input size="medium" class="w200" v-model="searchFields.payer_name"></el-input>
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
                        <el-tab-pane label="未支付" name="0"></el-tab-pane>
                        <el-tab-pane label="已支付" name="1"></el-tab-pane>
                    </el-tabs>
                </div>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="transaction_id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="out_trade_no" width="200" label="交易流水"></el-table-column>
                    <el-table-column prop="payer_name" width="120" label="付款方"></el-table-column>
                    <el-table-column prop="subject" label="商品名称"></el-table-column>
                    <el-table-column prop="amount" width="80" label="交易金额"></el-table-column>
                    <el-table-column prop="pay_state_des" width="100" label="付款状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="交易时间"></el-table-column>
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
        name: "TransactionList",
        components: {
            AdminFrame
        },
        data() {
            return {
                items: [],
                page: 1,
                total: 0,
                offset: 0,
                pageSize: 15,
                selectionIds: [],
                searchFields: {
                    out_trade_no: '',
                    subject: '',
                    payer_name: '',
                    pay_state: ''
                },
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/transaction/batchget', {
                    ...this.searchFields,
                    offset: this.offset,
                }).then(response => {
                    const {items, total} = response.result;
                    this.items = items;
                    this.total = total;
                });
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleDelete() {
                var items = this.selectionIds.map((d) => d.transaction_id);
                this.$confirm('此操作将永久删除所选记录, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/transaction/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch() {
                this.fetchList();
            },
            handleTabClick(tab) {
                this.searchFields.pay_state = tab.name;
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
