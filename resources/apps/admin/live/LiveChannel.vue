<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex-fill">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>直播管理</el-breadcrumb-item>
                    <el-breadcrumb-item>直播频道</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>直播频道</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加频道</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="channel_id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="channel_id" label="ID" width="50"></el-table-column>
                    <el-table-column prop="name" label="名称"></el-table-column>
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
                    <td class="cell-label">频道</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="channel.name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">排序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="channel.displayorder"></el-input>
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
        name: "LiveChannel",
        components: {
            AdminFrame
        },
        data() {
            return {
                items: [],
                channel: {},
                showDialog: false,
                selectionIds: []
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList () {
                this.$get('/live/channel/getall').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/live/channel/save', {
                    channel_id: this.channel.channel_id,
                    channel: this.channel
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.channel = {};
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d) => d.channel_id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/live/channel/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.channel.name) {
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
                this.channel = d;
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
