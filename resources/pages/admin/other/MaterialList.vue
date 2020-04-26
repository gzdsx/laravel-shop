<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>素材管理</el-breadcrumb-item>
                <el-breadcrumb-item>素材列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">素材名称</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" v-model="searchFields.name"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">用户ID</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" v-model="searchFields.uid"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">用户名称</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" v-model="searchFields.username"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <el-button size="medium" type="primary" @click="handleSearch">查询</el-button>
                    </div>
                </div>
            </div>

            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" value="image">
                        <el-tab-pane
                                v-for="(v,k) in materialTypes"
                                :key="k"
                                :label="v"
                                :name="k"
                        ></el-tab-pane>
                    </el-tabs>
                </div>

                <el-table :data="itemList" v-loading="loading" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <div class="bg-cover w60 h60" :style="{'background-image':'url('+scope.row.thumb+')'}"></div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="name" label="素材名称"></el-table-column>
                    <el-table-column prop="user.username" width="200" label="所属用户"></el-table-column>
                    <el-table-column prop="formated_size" width="100" label="大小"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="发布时间"></el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">批量删除</el-button>
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
        name: "MaterialList",
        components:{
            AdminFrame
        },
        data:function () {
            return{
                itemList: [],
                total: 0,
                offset:0,
                pageSize: 10,
                selectionIds:[],
                materialTypes:{
                    "image":"图片",
                    "video":"视频",
                    "voice":"声音",
                    "doc":"文档",
                    "file":"其他"
                },
                searchFields:{
                    name:'',
                    uid:'',
                    username:'',
                    type:'image'
                },
                loading:true
            }
        },
        mounted() {
            this.fetchList();
        },
        methods:{
            fetchList: function () {
                this.loading = true;
                this.$axios.get('/admin/material/batchget',{
                    params:{
                        ...this.searchFields,
                        offset:this.offset
                    }
                }).then(response => {
                    const {items, total} = response.data;
                    this.itemList = items;
                    this.total = total;
                    this.loading = false;
                });
            },
            handleSelectionChange:function (val) {
                this.selectionIds = val;
            },
            handleDelete:function () {
                var items = this.selectionIds.map((d)=>d.id);
                this.$confirm('此操作将永久删除所选素材, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/material/delete',{items}).then(response=>{
                        this.fetchList();
                    });
                });
            },
            handlerPageChange:function (page) {
                this.offset = (page-1) * this.pageSize;
                this.itemList = [];
                this.fetchList();
            },
            handleSearch:function () {
                this.offset = 0;
                this.fetchList();
            },
            handleTabClick:function (tab) {
                this.offset = 0;
                this.searchFields.type = tab.name;
                this.itemList = [];
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
