<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>页面管理</el-breadcrumb-item>
                <el-breadcrumb-item>页面列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick">
                        <el-tab-pane label="全部"></el-tab-pane>
                        <el-tab-pane
                                v-for="(catlog,index) in catlogs"
                                :key="index"
                                :label="catlog.title"
                                :name="catlog.pageid"
                        ></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/pages/edit">
                            <el-button type="primary" size="small">添加页面</el-button>
                        </router-link>
                    </div>
                </div>

                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="pageid" width="45" type="selection"></el-table-column>
                    <el-table-column prop="title" label="页面标题">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="alias" label="别名"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="发布时间"></el-table-column>
                    <el-table-column width="50">
                        <template slot-scope="scope">
                            <router-link :to="'/pages/edit/'+scope.row.pageid">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">批量删除</el-button>
                    <div class="flex"></div>
                </div>
            </div>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    export default {
        name: "PagesList",
        components:{
            AdminFrame
        },
        data: function () {
            return {
                catid:0,
                itemList: [],
                catlogs: [],
                selectionIds:[]
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/admin/pages/batchget',{
                    params:{
                        catid:this.catid
                    }
                }).then(response => {
                    this.itemList = response.data.items;
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/admin/pages/catlog/batchget').then(response => {
                    this.catlogs = response.data.items;
                });
            },
            handleSelectionChange:function (val) {
                this.selectionIds = val;
            },
            handleDelete:function () {
                var items = this.selectionIds.map((d)=>d.pageid);
                this.$confirm('此操作将永久删除所选页面, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/pages/delete',{items}).then(response=>{
                        this.fetchList();
                    });
                });
            },
            handleTabClick:function (tab) {
                this.catid = tab.name;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
