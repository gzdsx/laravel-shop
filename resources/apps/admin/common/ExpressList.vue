<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">快递管理</h2>
            <div>
                <el-button type="primary" size="small" @click="onShowAdd">添加快递</el-button>
            </div>
        </div>
        <div class="page-section">
            <el-table :data="dataList" @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column prop="name" width="200" label="快递名称"/>
                <el-table-column prop="code" width="200" label="公司代码"/>
                <el-table-column prop="regular" label="单号规则"/>
                <el-table-column width="50" label="选项">
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
export default {
    name: "ExpressList",
    data() {
        return {
            dataList: [],
            express: {},
            showDialog: false,
            selectionIds: []
        }
    },
    methods: {
        fetchList() {
            this.$get('/expresses').then(response => {
                this.dataList = response.result.items;
            });
        },
        onDelete() {
            let ids = this.selectionIds.map((d) => d.id);
            this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/express/delete', {ids}).then(response => {
                    this.fetchList();
                });
            });
        },
        onSubmit() {
            let {express} = this;
            if (!express.name) {
                this.$showToast('请填写快递名称');
                return false;
            }
            if (!express.code) {
                this.$showToast('请快递公司代码');
                return false;
            }

            this.$post('/express', {express}).then(() => {
                this.showDialog = false;
                this.$message.success('信息已保存');
                this.resetData();
                this.fetchList();
            });
        },
        onShowAdd() {
            this.resetData();
            this.showDialog = true;
        },
        onShowEdit(d) {
            this.express = d;
            this.showDialog = true;
        },
        onSelectionChange(val) {
            this.selectionIds = val;
        },
        resetData() {
            this.express = {};
        },
    },
    mounted() {
        this.fetchList();
    },
}
</script>

<style scoped>

</style>
