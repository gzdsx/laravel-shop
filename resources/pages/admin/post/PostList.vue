<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>文章管理</el-breadcrumb-item>
                <el-breadcrumb-item>文章列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="form-inline">
                    <el-form :inline="true">
                        <el-form-item label="文章标题">
                            <el-input size="medium" class="w150" v-model="searchFields.title"></el-input>
                        </el-form-item>
                        <el-form-item label="目录分类">
                            <el-select class="w150" size="medium" placeholder="请选择" value=""
                                       v-model="searchFields.catid">
                                <el-option
                                        v-for="(catlog,index) in catlogs"
                                        :key="index"
                                        :label="catlog.name"
                                        :value="catlog.catid">
                                </el-option>
                            </el-select>
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
                    <div class="buttons-wrapper">
                        <router-link to="/post/edit">
                            <el-button type="primary" size="small">添加文章</el-button>
                        </router-link>
                    </div>
                </div>
                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="aid" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <div @click="handleChangeImage(scope.row)">
                                <div class="bg-cover w60 h60" :style="{'background-image':'url('+scope.row.image+')'}"
                                     v-if="scope.row.image"></div>
                                <div class="bg-cover w60 h60" v-else></div>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" label="文章标题">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="user.username" width="120" label="用户"></el-table-column>
                    <el-table-column prop="catlog.name" width="120" label="目录分类"></el-table-column>
                    <el-table-column prop="views" width="80" label="点击"></el-table-column>
                    <el-table-column prop="state_des" width="100" label="状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="发布时间"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/post/edit/'+scope.row.aid">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
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
        name: "PostList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                itemList: [],
                total: 0,
                offset: 0,
                pageSize: 15,
                catlogs: [],
                selectionIds: [],
                searchFields: {
                    title: '',
                    catid: '',
                    username: '',
                    state: ''
                },
                post:{}
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/admin/post/batchget', {
                    params: {
                        ...this.searchFields,
                        offset: this.offset
                    }
                }).then(response => {
                    const {items, per_page, total} = response.data;
                    this.itemList = items;
                    this.total = total;
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/admin/post/catlog/getall').then(response => {
                    this.catlogs = response.data.items;
                });
            },
            handleSelectionChange: function (val) {
                this.selectionIds = val;
            },
            handleDelete: function () {
                var items = this.selectionIds.map((d) => d.aid);
                this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/post/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * this.pagesize;
                this.fetchList();
            },
            handleSearch: function () {
                this.fetchList();
            },
            handleTabClick: function (tab) {
                this.searchFields.state = tab.name;
                this.fetchList();
            },
            handleChangeImage: function (p) {
                this.post = p;
            }
        }
    }
</script>

<style scoped>

</style>
