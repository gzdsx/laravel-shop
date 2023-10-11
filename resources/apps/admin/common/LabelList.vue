<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">自定义标签</h2>
            <div>
                <el-button type="primary" size="small" @click="onShowAdd">新建标签</el-button>
            </div>
        </div>
        <div class="page-section">
            <el-table :data="dataList" @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column prop="id" width="80" label="ID"/>
                <el-table-column prop="title" label="标签名称"/>
                <el-table-column width="100" label="使用状态">
                    <template slot-scope="scope">
                        <span v-if="scope.row.state === 1">使用中</span>
                        <span style="color: #ff0000;" v-else>已停用</span>
                    </template>
                </el-table-column>
                <el-table-column prop="created_at" label="添加时间" width="170"/>
                <el-table-column width="50" label="选项">
                    <template slot-scope="scope">
                        <a @click="onShowEdit(scope.row)">编辑</a>
                    </template>
                </el-table-column>
            </el-table>
            <div class="tablenav-bottom">
                <div class="table-actions">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate({state:1})">
                        启用
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate({state:0})">
                        停用
                    </el-button>
                </div>
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

        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 400px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">标签名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="label.title"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">标签内容</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="6" v-model="label.content"></el-input>
                    </td>
                    <td class="cell-tips">支持文字内容或HTML代码</td>
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
    </main-layout>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "LabelList",
        mixins: [PaginationMixin],
        data() {
            return {
                label: {},
                showDialog: false,
                listApi: '/labels'
            }
        },
        methods: {
            resetData() {
                this.label = {};
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/label/delete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {label} = this;
                if (!label.title) {
                    this.$showToast('请填写标签名称');
                    return false;
                }
                if (!label.content) {
                    this.$showToast('请填写标签内容');
                    return false;
                }

                this.$post('/label', {label}).then(() => {
                    this.showDialog = false;
                    this.resetData();
                    this.fetchList();
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.label = d;
                this.showDialog = true;
            },
            onSelectionChange(val) {
                this.selectionIds = val;
            },
            onBatchUpdate(data) {
                let ids = this.selectionIds.map((d) => d.id);
                this.$post('/label/batch_update', {ids, data}).then(response => {
                    this.fetchList();
                });
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
