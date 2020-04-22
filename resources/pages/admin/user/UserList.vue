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
                <div class="form-inline">
                    <el-form :inline="true">
                        <el-form-item label="用户名">
                            <el-input size="medium" class="w150" v-model="searchFields.username"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button size="medium" type="primary" @click="handleSearch">查询</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>

            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="审核通过" name="1"></el-tab-pane>
                        <el-tab-pane label="等待审核" name="0"></el-tab-pane>
                        <el-tab-pane label="审核不过" name="-1"></el-tab-pane>
                    </el-tabs>
                </div>
                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="aid" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image :src="scope.row.avatar" class="w50 h50" fit="cover"></el-image>
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
                            <router-link :to="'/edit/'+scope.row.uid">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">批量删除</el-button>
                    <el-button size="small" :disabled="selectionIds.length===0">批量修改</el-button>
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
        components:{
            AdminFrame
        },
        data: function () {
            return {
                itemList: [],
                total: 0,
                pageSize: 15,
                currentPage:1,
                catlogs: [],
                selectionIds:[],
                searchFields: {
                    title: '',
                    catid: '',
                    username:'',
                    state:''
                }
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/user/batchget',{
                    params:{
                        ...this.searchFields,
                        page:this.currentPage
                    }
                }).then(response => {
                    const {items, per_page, total} = response.data;
                    this.itemList = items;
                    this.total = total;
                });
            },
            handleSelectionChange:function (val) {
                this.selectionIds = val;
            },
            handleDelete:function () {
                var items = this.selectionIds.map((d)=>d.uid);
                this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/post/batchdelete',{items}).then(response=>{
                        this.fetchList();
                    });
                });
            },
            handlerPageChange:function (page) {
                this.currentPage = page;
                this.fetchList();
            },
            handleSearch:function () {
                this.fetchList();
            },
            handleTabClick:function (tab) {
                this.searchFields.state = tab.name;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
