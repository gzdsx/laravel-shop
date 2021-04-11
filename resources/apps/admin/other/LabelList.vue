<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>后台管理</el-breadcrumb-item>
                <el-breadcrumb-item>自定义标签</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>标签列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">新建标签</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="id" width="80" label="ID"></el-table-column>
                    <el-table-column prop="title" label="标签名称"></el-table-column>
                    <el-table-column width="100" label="使用状态">
                        <template slot-scope="scope">
                            <span v-if="scope.row.state === 1">使用中</span>
                            <span style="color: #ff0000;" v-else>已停用</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="created_at" label="添加时间" width="170"></el-table-column>
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
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate({state:1})">
                        启用
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate({state:0})">
                        停用
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
        name: "LabelList",
        components: {
            AdminFrame,
        },
        data () {
            return {
                items: [],
                id: 0,
                label: {},
                showDialog: false,
                selectionIds: [],
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/label/batchget').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/label/save', {
                    id: this.id,
                    label: this.label
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.id = '';
                this.label = {};
            },
            handleDelete(id) {
                let items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/label/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.label.title) {
                    this.$showToast('请填写标签名称');
                    return false;
                }
                if (!this.label.content) {
                    this.$showToast('请填写标签内容');
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
                this.id = d.id;
                this.label = d;
                this.showDialog = true;
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleBatchUpdate(data) {
                let items = this.selectionIds.map((d) => d.id);
                this.$post('/label/batchupdate', {items, data}).then(response => {
                    this.fetchList();
                });
            }
        }
    }
</script>

<style scoped>

</style>
