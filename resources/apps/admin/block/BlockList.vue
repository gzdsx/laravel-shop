<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>内容模块</el-breadcrumb-item>
                <el-breadcrumb-item>模块列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>模块列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加模块</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="block_id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="block_name" width="200" label="模块名称"></el-table-column>
                    <el-table-column prop="block_desc" label="备注说明"></el-table-column>
                    <el-table-column width="120" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/block/item?block_id='+scope.row.block_id" target="_blank">管理项目</router-link>
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
                    <col style="width: 350px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">模块名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="block.block_name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">模块介绍</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="5" class="w-100" v-model="block.block_desc"></el-input>
                    </td>
                    <td class="cell-tips">模块参数介绍等</td>
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
        name: "BlockList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                items: [],
                block: {},
                block_id: 0,
                showDialog: false,
                selectionIds: []
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$get('/block/batchget').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/block/save', {
                    block_id: this.block_id,
                    block: this.block
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.block_id = '';
                this.block = {};
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d)=>d.block_id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/block/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.block.block_name) {
                    this.$showToast('请填写模块名称');
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
                this.block = d;
                this.block_id = d.block_id;
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
