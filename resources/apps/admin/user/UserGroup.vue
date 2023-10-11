<template>
    <main-layout>
        <h2 slot="header">用户分组</h2>

        <div class="page-section">
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
                        <el-input size="medium" v-model="group.name"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">积分下限</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.credits"/>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">备注</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.memo"/>
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
    </main-layout>
</template>

<script>
import UserService from "../utils/UserService";

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
            UserService.listGroups().then((response) => {
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

            UserService.storeGroup(group).then(() => {
                this.showDialog = false;
                this.$message.success('信息已保存');
                this.fetchList();
            });
        },
        onDelete() {
            let ids = this.selectionIds.map((d) => d.gid);
            this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                UserService.deleteGroup(ids).then(() => {
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
