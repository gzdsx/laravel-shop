<template>
    <div>
        <header class="page-header">
            <div class="page-title">交易流水</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="form-inline">
                    <el-form :inline="true">
                        <el-form-item label="交易流水">
                            <el-input size="medium" class="w200" v-model="params.out_trade_no"></el-input>
                        </el-form-item>
                        <el-form-item label="商品名称">
                            <el-input size="medium" class="w200" v-model="params.detail"></el-input>
                        </el-form-item>
                        <el-form-item label="用户ID">
                            <el-input size="medium" class="w200" v-model="params.uid"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>

            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="未支付" name="0"></el-tab-pane>
                        <el-tab-pane label="已支付" name="1"></el-tab-pane>
                    </el-tabs>
                </div>
                <el-table :data="dataList" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="out_trade_no" width="200" label="交易流水"/>
                    <el-table-column prop="user.username" width="120" label="用户"/>
                    <el-table-column prop="detail" label="明细"/>
                    <el-table-column prop="amount" width="100" label="交易金额"/>
                    <el-table-column prop="pay_state_des" width="100" label="付款状态"/>
                    <el-table-column prop="created_at" width="170" label="交易时间"/>
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
        name: "Transaction",
        mixins: [PaginationMixin],
        data() {
            return {
                params: {
                    out_trade_no: '',
                    detail: '',
                    pay_state: '',
                    uid: ''
                },
                listApi: '/trade/transaction.list'
            }
        },
        methods: {
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选记录, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/trade/transaction.batchdelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.pay_state = tab.name;
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
