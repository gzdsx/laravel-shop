<template>
    <div>
        <header class="page-header">
            <div class="page-title">素材管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">素材名称</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" v-model="params.name"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">用户ID</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" v-model="params.uid"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">用户名称</div>
                        <div class="form-item-input">
                            <el-input size="medium" class="w200" v-model="params.nickname"></el-input>
                        </div>
                    </div>
                    <div class="form-item">
                        <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                    </div>
                </div>
            </div>

            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" value="image">
                        <el-tab-pane
                                v-for="(v,k) in materialTypes"
                                :key="k"
                                :label="v"
                                :name="k"
                        ></el-tab-pane>
                    </el-tabs>
                </div>

                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image :src="scope.row.thumb" class="img-60" fit="cover"/>
                        </template>
                    </el-table-column>
                    <el-table-column prop="name" label="素材名称"/>
                    <el-table-column prop="user.nickname" width="200" label="所属用户"/>
                    <el-table-column prop="formated_size" width="100" label="大小"/>
                    <el-table-column prop="created_at" width="170" label="发布时间"/>
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
    </div>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "MaterialList",
        mixins:[PaginationMixin],
        data() {
            return {
                materialTypes: {
                    "image": "图片",
                    "video": "视频",
                    "voice": "声音",
                    "doc": "文档",
                    "file": "其他"
                },
                params: {
                    name: '',
                    uid: '',
                    username: '',
                    type: 'image'
                },
                listApi:'/common/material.getList'
            }
        },
        methods: {
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选素材, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/material.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.type = tab.name;
                this.onSearch();
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
