<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>用户管理</el-breadcrumb-item>
                <el-breadcrumb-item>用户列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">用户名</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" clearable v-model="searchFields.username"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">手机号</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" clearable v-model="searchFields.mobile"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">邮箱</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" clearable v-model="searchFields.emial"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <el-button size="medium" type="primary" @click="handleSearch">查询</el-button>
                    </div>
                </div>
            </div>

            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="审核通过" name="1"></el-tab-pane>
                        <el-tab-pane label="等待审核" name="0"></el-tab-pane>
                        <el-tab-pane label="禁止登录" name="-1"></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/user/edit">
                            <el-button type="primary" size="small">添加用户</el-button>
                        </router-link>
                    </div>
                </div>
                <el-table :data="itemList" v-loading="loading" style="width: 100%"
                          @selection-change="handleSelectionChange">
                    <el-table-column prop="aid" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image :src="scope.row.avatar" class="img-40" fit="cover"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column label="用户名">
                        <template slot-scope="scope">
                            <a>{{scope.row.username}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="mobile" label="手机号"></el-table-column>
                    <el-table-column prop="email" label="邮箱"></el-table-column>
                    <el-table-column prop="state_des" width="80" label="状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="注册时间"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/user/edit/'+scope.row.uid">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate({state:1})">
                        审核通过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate({freeze:0})">
                        禁止登录
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate({freeze:1})">
                        允许登录
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            @current-change="handlerPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "UserList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                itemList: [],
                total: 0,
                pageSize: 15,
                offset: 0,
                catlogs: [],
                selectionIds: [],
                searchFields: {
                    username: '',
                    state: '',
                    emial: '',
                    mobile: ''
                },
                loading: true
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.loading = true;
                this.$axios.get('/admin/user/batchget', {
                    params: {
                        ...this.searchFields,
                        offset: this.offset
                    }
                }).then(response => {
                    const {items, total} = response.data;
                    this.itemList = items;
                    this.total = total;
                    this.loading = false;
                });
            },
            handleSelectionChange: function (val) {
                this.selectionIds = val;
            },
            handleDelete: function () {
                var items = this.selectionIds.map((d) => d.uid);
                this.$confirm('此操作将永久删除所选用户, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/user/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch: function () {
                this.fetchList();
            },
            handleTabClick: function (tab) {
                this.searchFields.state = tab.name;
                this.offset = 0;
                this.fetchList();
            },
            handleBatchUpdate: function (params) {
                var items = this.selectionIds.map((d) => d.uid);
                this.$axios.post('/admin/user/batchupdate', {items, params}).then(response => {
                    this.fetchList();
                });
            }
        }
    }
</script>

<style scoped>

</style>
