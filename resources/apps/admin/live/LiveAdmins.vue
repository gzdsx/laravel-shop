<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex-fill">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>直播管理</el-breadcrumb-item>
                    <el-breadcrumb-item>人员设置</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>直播管理员列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加管理员</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="uid" width="80" label="UID"></el-table-column>
                    <el-table-column prop="user.username" width="200" label="名称"></el-table-column>
                    <el-table-column prop="remark" label="备注"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="添加时间"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <a @click="handleShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
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
                    <td class="cell-label">UID</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="admin.uid"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">备注</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="admin.remark"></el-input>
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
        name: "LiveAdmins",
        components: {
            AdminFrame
        },
        data() {
            return {
                items: [],
                admin: {},
                showDialog: false,
                selectionIds: []
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/live/admin/getall').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/live/admin/save', this.admin).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                }).catch(reason => {
                    this.$showToast(reason.data.errmsg);
                });
            },
            resetData() {
                this.admin = {};
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/live/admin/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.admin.uid) {
                    this.$showToast('请填写频道名称');
                    return false;
                }
                this.showDialog = false;
                this.saveData();
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(d) {
                this.admin = d;
                this.showDialog = true;
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
        }
    }
</script>

<style scoped>

</style>
