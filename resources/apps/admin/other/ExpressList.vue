<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>快递管理</el-breadcrumb-item>
                <el-breadcrumb-item>快递列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>快递列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加快递</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="name" width="200" label="快递名称"></el-table-column>
                    <el-table-column prop="code" width="200" label="公司代码"></el-table-column>
                    <el-table-column prop="regular" label="单号规则"></el-table-column>
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
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">快递名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="express.name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">公司代码</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="express.code"></el-input>
                    </td>
                    <td class="cell-tips">快递公司英文代码</td>
                </tr>
                <tr>
                    <td class="cell-label">单号规则</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="express.regular"></el-input>
                    </td>
                    <td class="cell-tips">单号正则表达式</td>
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
        name: "ExpressList",
        components: {
            AdminFrame
        },
        data () {
            return {
                items: [],
                id: 0,
                express: {},
                showDialog: false,
                selectionIds: []
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList () {
                this.$get('/express/getall').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/express/save', {
                    id: this.id,
                    express: this.express
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.id = '';
                this.express = {};
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d)=>d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/express/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.express.name) {
                    this.$showToast('请填写快递名称');
                    return false;
                }
                if (!this.express.code) {
                    this.$showToast('请快递公司代码');
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
                this.express = d;
                this.id = d.id;
                this.showDialog = true;
            },
            handleSelectionChange(val){
                this.selectionIds = val;
            },
        }
    }
</script>

<style scoped>

</style>
