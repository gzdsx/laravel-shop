<template>
    <div>
        <header class="page-header">
            <div class="page-title">用户分组</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>分组列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd">添加分组</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="dataList" :loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="gid" width="60" label="GID"/>
                    <el-table-column prop="name" label="分组名称" width="200"/>
                    <el-table-column prop="credits" label="积分下线" width="200"/>
                    <el-table-column prop="memo" label="备注"/>
                    <el-table-column label="选项" width="80" align="right">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
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
        <el-dialog width="500px" title="编辑分组" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">分组名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">积分下限</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.credits"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">备注</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.memo"></el-input>
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
        name: "UserGroup",
        data() {
            return {
                loading: false,
                group: {},
                dataList: [],
                selectionIds: [],
                showDialog: false
            }
        },
        methods: {
            fetchList() {
                this.loading = true;
                this.$get('/user/group.getList').then(response => {
                    this.dataList = response.result.items;
                    this.loading = false;
                });
            },
            onShowEdit(d) {
                this.group = d;
                this.showDialog = true;
            },
            onShowAdd() {
                this.group = {};
                this.showDialog = true;
            },
            onSubmit() {
                let {group} = this;
                if (!group.name) {
                    this.$showToast('请填写分组名称');
                    return false;
                }

                let {gid} = group;
                this.$post('/user/group.save', {gid, group}).then(() => {
                    this.fetchList();
                    this.group = {};
                    this.showDialog = false;
                    this.$showToast('信息保存成功');
                });
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.gid);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/user/group..batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onSelectionChange(val) {
                this.selectionIds = val;
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
