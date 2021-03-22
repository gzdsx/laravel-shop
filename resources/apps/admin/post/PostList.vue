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
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">文章标题</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" :clearable="true"
                                      v-model="searchFields.title"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">文章作者</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" :clearable="true"
                                      v-model="searchFields.auth"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">目录分类</div>
                        <div class="form-item-input">
                            <el-cascader
                                    :options="nodes"
                                    size="medium"
                                    class="w200"
                                    :clearable="true"
                                    style="height: 36px;"
                                    @change="onSascaderChange"
                            ></el-cascader>
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
                        <el-tab-pane label="审核不过" name="-1"></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/post/edit" target="_blank">
                            <el-button type="primary" size="small">添加文章</el-button>
                        </router-link>
                    </div>
                </div>
                <el-table :data="items" v-loading="loading" style="width: 100%"
                          @selection-change="handleSelectionChange">
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
                    <el-table-column prop="category.name" width="120" label="目录分类"></el-table-column>
                    <el-table-column prop="views" width="80" label="点击"></el-table-column>
                    <el-table-column prop="state_des" width="100" label="状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="发布时间"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/post/edit?aid='+scope.row.aid" target="_blank">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate(1)">审核通过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="handleBatchUpdate(-1)">审核不过
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            @current-change="handlePageChange"
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
                items: [],
                total: 0,
                offset: 0,
                pageSize: 15,
                selectionIds: [],
                searchFields: {
                    title: '',
                    catid: '',
                    username: '',
                    state: ''
                },
                post: {},
                loading: true,
                nodes: [],
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList() {
                this.loading = true;
                this.$get('/post/batchget', {
                    ...this.searchFields,
                    offset: this.offset
                }).then(response => {
                    const {items, total} = response.data;
                    this.items = items;
                    this.total = total;
                    this.loading = false;
                });
            },
            fetchCatlogs() {
                this.$get('/post/category/getall').then(response => {
                    this.nodes = this.serilazeProps(response.data.items);
                });
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleDelete() {
                var items = this.selectionIds.map((d) => d.aid);
                this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/post/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch() {
                this.offset = 0;
                this.fetchList();
            },
            handleTabClick(tab) {
                this.searchFields.state = tab.name;
                this.offset = 0;
                this.fetchList();
            },
            handleChangeImage(p) {
                this.post = p;
            },
            handleBatchUpdate(state) {
                var items = this.selectionIds.map((d) => d.aid);
                this.$post('/post/batchupdate', {items, data: {state}}).then(response => {
                    this.fetchList();
                });
            },
            serilazeProps(arr) {
                function t(a) {
                    return a.map(function (c) {
                        var obj = {
                            value: c.catid,
                            label: c.name,
                        };
                        if (c.children.length > 0) {
                            obj.children = t(c.children);
                        }
                        return obj;
                    });
                }

                return t(arr);
            },
            onSascaderChange(arr) {
                this.searchFields.catid = arr[arr.length - 1];
            }
        }
    }
</script>

<style scoped>

</style>
