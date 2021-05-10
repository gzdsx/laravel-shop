<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>后台管理</el-breadcrumb-item>
                <el-breadcrumb-item>菜单管理</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>菜单列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">新建菜单</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="menu_id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="menu_id" width="50" label="ID"></el-table-column>
                    <el-table-column prop="title" label="菜单名称"></el-table-column>
                    <el-table-column width="140" label="选项">
                        <template slot-scope="scope">
                            <a @click="handleShowEdit(scope.row)">编辑</a>
                            <span>|</span>
                            <router-link :to="'/menu/item?menu_id='+scope.row.menu_id">管理菜单项</router-link>
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
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 400px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">菜单名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.title"></el-input>
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
        name: "MenuList",
        components: {
            AdminFrame,
        },
        data () {
            return {
                items: [],
                menu_id: 0,
                menu: {},
                showDialog: false,
                selectionIds: [],
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/menu/batchget').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/menu/save', {
                    menu_id: this.menu_id,
                    menu: this.menu
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.menu_id = '';
                this.menu = {};
            },
            handleDelete(id) {
                let items = this.selectionIds.map((d) => d.menu_id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/menu/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.menu.title) {
                    this.$showToast('请填写菜单名称');
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
                this.menu_id = d.menu_id;
                this.menu = d;
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
