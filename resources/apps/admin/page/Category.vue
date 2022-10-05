<template>
    <div>
        <header class="page-header">
            <div class="page-title">分类管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <div class="table-edit-title">分类列表</div>
                    <div class="buttons-wrapper">
                        <el-button type="primary" size="small" @click="onShowAdd">添加分类</el-button>
                    </div>
                </div>

                <el-table :data="dataList">
                    <el-table-column prop="cate_id" label="ID" width="60"/>
                    <el-table-column prop="cate_name" label="分类名称"/>
                    <el-table-column prop="sort_num" label="排序" width="80"/>
                    <el-table-column width="90" label="操作选项">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                            <a @click="onDelete(scope.row.cate_id)">删除</a>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
        <el-dialog title="编辑分类" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">分类名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.cate_name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">分类排序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.sort_num"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" :disabled="disabled" @click="onSubmit">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "Category",
        data: function () {
            return {
                dataList: [],
                category: {},
                showDialog: false,
                disabled: false
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/page/category.getList').then(response => {
                    this.dataList = response.result.items;
                });
            },
            onDelete(cate_id) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/page/category.delete', {cate_id}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {category} = this;
                let {cate_id} = category;
                if (!category.cate_name) {
                    this.$showToast('请填写分类名称');
                    return false;
                }

                this.disabled = true;
                this.$post('/page/category.save', {cate_id, category}).then(response => {
                    this.resetData();
                    this.showDialog = false;
                    this.fetchList();
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.category = d;
                this.showDialog = true;
            },
            resetData() {
                this.category = {
                    cate_name: null,
                    sort_num: 0
                };
                this.disabled = false;
            }
        }
    }
</script>

<style scoped>

</style>
