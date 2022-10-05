<template>
    <div>
        <header class="page-header">
            <div class="page-title">文章管理</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">文章标题</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" :clearable="true"
                                      v-model="params.title"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">文章作者</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" :clearable="true"
                                      v-model="params.author"></el-input>
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
                        <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                    </div>
                </div>
            </div>

            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" value="all">
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
                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <div @click="onChangeImage(scope.row)">
                                <el-image :src="scope.row.image" class="img-60" v-if="scope.row.image"/>
                                <div class="img-placeholder img-60" v-else></div>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" label="文章标题">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="user.nickname" width="120" label="用户"/>
                    <el-table-column prop="category.cate_name" width="120" label="目录分类"/>
                    <el-table-column prop="views" width="80" label="点击"/>
                    <el-table-column prop="state_des" width="100" label="状态"/>
                    <el-table-column prop="created_at" width="170" label="发布时间"/>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/post/edit/'+scope.row.aid" target="_blank">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate(1)">审核通过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate(-1)">审核不过
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
    </div>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "PostList",
        mixins: [PaginationMixin],
        data() {
            return {
                listApi: '/post/item.getList',
                params: {
                    title: '',
                    cate_id: '',
                    username: '',
                    state: '',
                    author: '',
                    sort: 'id-desc'
                },
                post: {},
                nodes: [],
            }
        },
        methods: {
            fetchCategoryList() {
                this.$get('/post/category.getList').then(response => {
                    this.nodes = this.serilazeProps(response.result.items);
                });
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.aid);
                this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/post/item.batchDelete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.state = tab.name;
                this.page = 1;
                this.fetchList();
            },
            onChangeImage(p) {
                this.post = p;
            },
            onBatchUpdate(state) {
                let ids = this.selectionIds.map((d) => d.aid);
                this.$post('/post/item.batchUpdate', {ids, data: {state}}).then(response => {
                    this.fetchList();
                });
            },
            onSascaderChange(arr) {
                if (arr) this.params.cate_id = arr[arr.length - 1];
            },
            serilazeProps(arr) {
                function t(a) {
                    return a.map(function (c) {
                        var obj = {
                            value: c.cate_id,
                            label: c.cate_name,
                        };
                        if (c.children.length > 0) {
                            obj.children = t(c.children);
                        }
                        return obj;
                    });
                }

                return t(arr);
            },
        },
        mounted() {
            this.fetchList();
            this.fetchCategoryList();
        },
    }
</script>

<style scoped>

</style>
