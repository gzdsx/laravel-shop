<template>
    <div>
        <header class="page-header">
            <div class="page-title">菜单管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>菜单列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowEdit">新建菜单</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="dataList" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="id" width="50" label="ID"/>
                    <el-table-column prop="name" label="菜单名称"/>
                    <el-table-column width="140" label="选项">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                            <span>|</span>
                            <router-link :to="'/menu/item/'+scope.row.id">管理菜单项</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
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
                    <col style="width: 400px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">菜单名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.name"></el-input>
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
    export default {
        name: "MenuList",
        data() {
            return {
                menu: {},
                dataList: [],
                showDialog: false,
                selectionIds: [],
            }
        },
        methods: {
            fetchList() {
                this.$get('/common/menu.getList').then(response => {
                    this.dataList = response.result.items;
                });
            },
            resetData() {
                this.menu = {};
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/menu.batchDelete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {menu} = this;
                let {id} = menu;
                if (!menu.name) {
                    this.$showToast('请填写菜单名称');
                    return false;
                }

                this.$post('/common/menu.save', {id, menu}).then(response => {
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
                this.menu = d;
                this.showDialog = true;
            },
            onSelectionChange(val) {
                this.selectionIds = val;
            },
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
