<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">文章管理</h2>
            <div>
                <router-link to="/post/edit">
                    <el-button type="primary" size="small">添加文章</el-button>
                </router-link>
            </div>
        </div>

        <section class="page-section">
            <div class="form-inline">
                <div class="form-item">
                    <div class="form-item-label">文章标题</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" :clearable="true" v-model="params.title"/>
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
                                @clear="params.cate=''"
                        ></el-cascader>
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item-label">状态</div>
                    <div class="form-item-input">
                        <el-select size="medium" v-model="params.status">
                            <el-option value="" label="不限"/>
                            <el-option value="publish" label="已发布"/>
                            <el-option value="draft" label="草稿"/>
                        </el-select>
                    </div>
                </div>
                <div class="form-item">
                    <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                </div>
            </div>
        </section>

        <section class="page-section">
            <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column label="图片" width="70">
                    <template slot-scope="scope">
                        <div @click="onChangeImage(scope.row)">
                            <el-image :src="scope.row.image" class="post-thumbnail" v-if="scope.row.image"/>
                            <div class="post-thumbnail" v-else></div>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="title" label="文章标题">
                    <template slot-scope="scope">
                        <div class="post-column-title"><a :href="scope.row.url" target="_blank">{{
                            scope.row.title
                            }}</a></div>
                        <div class="post-column-actions">
                            <router-link :to="'/post/edit/'+scope.row.id" target="_blank">编辑</router-link>
                            <span>|</span>
                            <a @click="onDelete(scope.row.id)">删除</a>
                            <span>|</span>
                            <a :href="scope.row.url" target="_blank">预览</a>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="user.nickname" width="120" label="用户"/>
                <el-table-column prop="category.cate_name" width="120" label="目录分类">
                    <template slot-scope="scope">
                        <div class="post-column-categories">
                            <a v-for="(cate,idx) in scope.row.categories">{{ cate.name }}</a>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="views" width="80" label="点击"/>
                <el-table-column prop="status_des" width="100" label="状态"/>
                <el-table-column prop="created_at" width="170" label="发布时间" align="right"/>
            </el-table>
            <div class="tablenav tablenav-bottom">
                <div class="table-actions">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate(1)">审核通过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate(-1)">审核不过
                    </el-button>
                </div>
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
        </section>
    </main-layout>
</template>

<script>
import PaginationMixin from "../mixins/PaginationMixin";

export default {
    name: "PostList",
    mixins: [PaginationMixin],
    data() {
        return {
            listApi: '/posts',
            params: {
                title: '',
                cate: '',
                status: '',
                sort: 'id-desc'
            },
            post: {},
            nodes: [],
        }
    },
    methods: {
        fetchCategories() {
            this.$get('/categories?taxonomy=category').then(response => {
                this.nodes = this.serilazeProps(response.result.items);
            });
        },
        deleteRecords(ids) {
            this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/post/delete', {ids}).then(response => {
                    this.fetchList();
                });
            });
        },
        onDelete(id) {
            this.deleteRecords([id]);
        },
        onBatchDelete() {
            let ids = this.selectionIds.map((d) => d.id);
            this.deleteRecords(ids);
        },
        onChangeImage(p) {
            this.post = p;
        },
        onBatchUpdate(status) {
            let ids = this.selectionIds.map((d) => d.id);
            this.$post('/post/batch_update', {ids, data: {status}}).then(() => {
                this.fetchList();
            });
        },
        onSascaderChange(arr) {
            if (arr.length > 0) this.params.cate = arr[arr.length - 1];
        },
        serilazeProps(arr) {
            function t(a) {
                return a.map(function (c) {
                    var obj = {
                        value: c.cate_id,
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
    },
    mounted() {
        this.fetchList();
        this.fetchCategories();
    },
}
</script>

<style scoped>

</style>
