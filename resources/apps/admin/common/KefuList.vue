<template>
    <div>
        <header class="page-header">
            <div class="page-title">客服管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>客服列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd">添加客服</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="dataList" :loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="title" label="客服名称"/>
                    <el-table-column prop="phone" width="200" label="电话"/>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
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
                            :current-page="page"
                            @current-change="onPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">客服名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="kefu.title"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">客服电话</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="kefu.phone"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" @click="onSubmit">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "KefuList",
        mixins: [PaginationMixin],
        data() {
            return {
                kefu: {},
                showDialog: false,
                listApi: '/common/kefu.getList'
            }
        },
        methods: {
            resetData() {
                this.kefu = {};
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/kefu.batchDelete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {kefu} = this;
                if (!kefu.title) {
                    this.$showToast('请填写客服名称');
                    return false;
                }
                if (!kefu.phone) {
                    this.$showToast('请填写客服电话');
                    return false;
                }

                let {id} = kefu;
                this.$post('/common/kefu.save', {id, kefu}).then(response => {
                    this.resetData();
                    this.fetchList();
                    this.showDialog = false;
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.kefu = d;
                this.showDialog = true;
            },
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
