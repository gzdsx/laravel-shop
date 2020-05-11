<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>页面管理</el-breadcrumb-item>
                <el-breadcrumb-item>页面分类</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <div class="table-edit-title">分类列表</div>
                    <div class="buttons-wrapper">
                        <el-button type="primary" size="small" @click="handleShowAdd">添加分类</el-button>
                    </div>
                </div>

                <el-table :data="itemList" style="width: 100%">
                    <el-table-column prop="title" label="分类名称"></el-table-column>
                    <el-table-column width="90" label="操作选项">
                        <template slot-scope="scope">
                            <a @click="handleShowEdit(scope.row)">编辑</a>
                            <a @click="handleDelete(scope.row.pageid)">删除</a>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">标题</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="pages.title"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">排序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="pages.displayorder"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" @click="handleSave">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "PagesCategory",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                itemList: [],
                pages: {},
                showDialog: false,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/admin/pages/catlog/batchget').then(response => {
                    this.itemList = response.data.items;
                });
            },
            handleDelete: function (pageid) {
                this.$confirm('此操作将永久删除所选页面, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/pages/delete', {items:[pageid]}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleUpdate(cb) {
                this.$post('/admin/pages/update', {
                    pageid: this.pages.pageid || 0,
                    pages: this.pages
                }).then(response => {
                    this.resetData();
                    if (cb) cb(response);
                });
            },
            handleSave() {
                if (!this.pages.title) {
                    this.$showToast('请填写标题');
                    return false;
                }
                this.showDialog = false;
                this.handleUpdate(() => {
                    this.resetData();
                    this.fetchList();
                });
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(d) {
                this.pages = d;
                this.showDialog = true;
            },
            resetData() {
                this.pages = {
                    type: 'category',
                    pageid: 0
                };
            }
        }
    }
</script>

<style scoped>

</style>
