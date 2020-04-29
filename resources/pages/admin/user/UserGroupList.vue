<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>用户管理</el-breadcrumb-item>
                    <el-breadcrumb-item>用户分组</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>分组列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加分组</el-button>
                        </div>
                    </div>
                </header>
                <table class="dsxui-listtable">
                    <colgroup>
                        <col style="width: 50px;">
                        <col>
                        <col style="width: 200px;">
                        <col style="width: 200px;">
                        <col style="width: 50px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <el-checkbox @change="handleCheckAll"></el-checkbox>
                        </th>
                        <th>分组名称</th>
                        <th>积分下限</th>
                        <th>积分上限</th>
                        <th>选项</th>
                    </tr>
                    </thead>
                </table>
                <el-checkbox-group ref="chkgroup" v-model="selectionIds">
                    <table class="dsxui-listtable">
                        <colgroup>
                            <col style="width: 50px;">
                            <col>
                            <col style="width: 200px;">
                            <col style="width: 200px;">
                            <col style="width: 50px;">
                        </colgroup>
                        <tbody>
                        <tr v-for="(group,index) in groupList" :key="index">
                            <td>
                                <el-checkbox :label="group.gid">{{''}}</el-checkbox>
                            </td>
                            <td>{{group.title}}</td>
                            <td>{{group.creditslower}}</td>
                            <td>{{group.creditshigher}}</td>
                            <td><a @click="handleShowEdit(group)">编辑</a></td>
                        </tr>
                        </tbody>
                    </table>
                </el-checkbox-group>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                </div>
            </div>
        </div>
        <el-dialog width="500px" title="编辑分组" closeable :visible.sync="showDialog">
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
                        <el-input size="medium" v-model="group.title"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">积分下限</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.creditslower"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">积分上限</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="group.creditshigher"></el-input>
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
        name: "UserGroupList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                groupList: [],
                group: {},
                selectionIds: [],
                showDialog: false
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/admin/user/group/getall').then(response => {
                    this.groupList = response.data.items;
                });
            },
            handleShowEdit(group) {
                this.group = group;
                this.showDialog = true;
            },
            handleShowAdd() {
                console.log(this.$refs.chkgroup);
                this.group = {};
                this.showDialog = true;
            },
            handleSave() {
                if (!this.group.title) {
                    this.$showToast('请填写分组名称');
                    return false;
                }
                this.showDialog = false;
                this.$post('/admin/user/group/update', {
                    gid: this.group.gid,
                    group: this.group,
                }).then(response => {
                    this.fetchList();
                    this.group = {};
                    this.$showToast('信息已更新');
                });
            },
            handleDelete() {
                var items = this.selectionIds;
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/admin/user/group/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleCheckAll(v){
                if (v) {
                    this.selectionIds = this.groupList.map((g)=>g.gid);
                }else {
                    this.selectionIds = [];
                }
            }
        }
    }
</script>

<style scoped>

</style>
