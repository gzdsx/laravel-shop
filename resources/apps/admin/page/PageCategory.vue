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

                <el-table :data="items" style="width: 100%">
                    <el-table-column prop="catid" label="ID" width="60"></el-table-column>
                    <el-table-column prop="name" label="分类名称"></el-table-column>
                    <el-table-column width="90" label="操作选项">
                        <template slot-scope="scope">
                            <a @click="handleShowEdit(scope.row)">编辑</a>
                            <a @click="handleDelete(scope.row.catid)">删除</a>
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
                        <el-input size="medium" v-model="category.name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">分类排序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.displayorder"></el-input>
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
        name: "PageCategory",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                items: [],
                category: {},
                showDialog: false,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/page/category/getall').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/page/category/save', {
                    category: this.category,
                    catid: this.category.catid || 0
                }).then(response => {
                    this.resetData();
                    if (cb) cb(response);
                });
            },
            handleDelete(catid) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/page/category/delete', {items: [catid]}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.category.name) {
                    this.$showToast('请填写分类名称');
                    return false;
                }
                this.showDialog = false;
                this.saveData(() => {
                    this.resetData();
                    this.fetchList();
                });
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(d) {
                this.category = d;
                this.showDialog = true;
            },
            resetData() {
                this.category = {};
            }
        }
    }
</script>

<style scoped>

</style>
