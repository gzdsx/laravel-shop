<template>
    <div>
        <header class="page-header">
            <div class="page-title">管理员管理</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header flex-row">
                    <div class="table-edit-title flex-fill">管理员列表</div>
                    <div>
                        <el-button type="primary" size="small" @click="onShowAdd">添加管理员</el-button>
                    </div>
                </div>
                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="uid" width="80" label="UID"/>
                    <el-table-column label="头像" width="70">
                        <template slot-scope="scope">
                            <el-image :src="scope.row.user.avatar" class="img-40" fit="cover"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column label="昵称">
                        <template slot-scope="scope">
                            <a>{{scope.row.user.nickname}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="group.name" width="120" label="分组"/>
                    <el-table-column prop="created_at" width="170" label="注册时间"/>
                    <el-table-column width="100px" label="选项" align="right">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            :current-page="page"
                            @current-change="onPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>

        <el-dialog width="500px" title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 60px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody v-if="!editMode">
                <tr>
                    <td class="cell-label">UID</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="admin.uid"></el-input>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <tbody>
                <tr>
                    <td class="cell-label">分组</td>
                    <td class="cell-input">
                        <el-select size="medium" class="w-100" v-model="admin.gid">
                            <el-option
                                    v-for="(group,index) in groupList"
                                    :key="index"
                                    :label="group.name"
                                    :value="group.gid"
                            />
                        </el-select>
                    </td>
                    <td></td>
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
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "AdminUser",
        mixins: [PaginationMixin],
        data() {
            return {
                admin: {},
                listApi: '/user/admin.user.getList',
                groupList: [],
                showDialog: false,
                editMode: false
            }
        },
        methods: {
            onShowAdd() {
                this.editMode = false;
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.admin = d;
                this.editMode = true;
                this.showDialog = true;
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选用户, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/user/admin.user.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {uid, gid} = this.admin;
                if (!uid) {
                    this.$showToast('请填写UID');
                    return false;
                }

                if (!gid) {
                    this.$showToast('请选择分组');
                    return false;
                }

                this.$post('/user/admin.user.save', {uid, gid}).then(response => {
                    this.admin = {};
                    this.showDialog = false;
                    this.fetchList();
                }).catch(r => {
                    this.$showToast(r.errMsg);
                });
            },
            fetchGroupList() {
                this.$get('/user/admin.group.getList').then(response => {
                    this.groupList = response.result.items;
                });
            }
        },
        mounted() {
            this.fetchList();
            this.fetchGroupList();
        },
    }
</script>

<style scoped>

</style>
