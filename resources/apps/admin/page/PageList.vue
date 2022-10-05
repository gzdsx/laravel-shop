<template>
    <div>
        <header class="page-header">
            <div class="page-title">页面管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" v-model="params.cate_id">
                        <el-tab-pane
                                v-for="(category,index) in categoryList"
                                :key="index"
                                :label="category.cate_name"
                                :name="category.cate_id.toString()"
                        ></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/page/edit">
                            <el-button type="primary" size="small">添加页面</el-button>
                        </router-link>
                    </div>
                </div>

                <el-table :data="dataList" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="id" label="ID" width="60"/>
                    <el-table-column prop="title" label="页面标题">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="alias" label="别名"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="发布时间"></el-table-column>
                    <el-table-column width="50">
                        <template slot-scope="scope">
                            <router-link :to="'/page/edit/'+scope.row.id">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <div class="flex"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PageList",
        data() {
            return {
                dataList: [],
                categoryList: [
                    {
                        cate_id: 0,
                        cate_name: '全部'
                    }
                ],
                selectionIds: [],
                params: {
                    cate_id: 0
                }
            }
        },
        methods: {
            fetchList() {
                let {params} = this;
                this.$get('/page/page.getList', params).then(response => {
                    this.dataList = response.result.items;
                });
            },
            fetchCategoryList() {
                this.$get('/page/category.getList').then(response => {
                    this.categoryList = this.categoryList.concat(response.result.items);
                });
            },
            onSelectionChange(val) {
                this.selectionIds = val;
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选页面, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/page/page.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.cate_id = tab.name;
                this.fetchList();
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCategoryList();
        },
    }
</script>

<style scoped>

</style>
