<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>商品管理</el-breadcrumb-item>
                <el-breadcrumb-item>商品列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="form-inline">
                    <el-form :inline="true">
                        <el-form-item label="产品名称">
                            <el-input size="medium" class="w150" v-model="searchFields.title"></el-input>
                        </el-form-item>
                        <el-form-item label="产品ID">
                            <el-input size="medium" class="w150" v-model="searchFields.itemid"></el-input>
                        </el-form-item>
                        <el-form-item label="目录分类">
                            <el-select class="w150"
                                       size="medium"
                                       placeholder="请选择"
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
                        <el-tab-pane label="出售中" name="onSale"></el-tab-pane>
                        <el-tab-pane label="已下架" name="offShelf"></el-tab-pane>
                        <el-tab-pane label="已售罄" name="soldOut"></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/item/edit">
                            <el-button type="primary" size="medium">添加商品</el-button>
                        </router-link>
                    </div>
                </div>
                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="itemid" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">
                                <div class="bg-cover w60 h60"
                                     :style="{'background-image':'url('+scope.row.thumb+')'}"></div>
                            </a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" label="名称"></el-table-column>
                    <el-table-column prop="price" width="100" label="价格"></el-table-column>
                    <el-table-column prop="stock" width="100" label="库存"></el-table-column>
                    <el-table-column prop="sold" width="80" label="销量"></el-table-column>
                    <el-table-column prop="sale_state_des" width="100" label="状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="上架时间"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/item/edit/'+scope.row.itemid">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length === 0" @click="handleDelete">批量删除</el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0">批量上架</el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0">批量下架</el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0">批量修改</el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next,total"
                            :total="total"
                            :page-size="pageSize"
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
        name: "ItemList",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                catlogs: [],
                itemList: [],
                total: 0,
                pageSize: 15,
                currentPage: 1,
                selectionIds: [],
                searchFields: {
                    title: '',
                    catid: '',
                    itemid: '',
                    tab: ''
                },
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/item/batchget', {
                    params: {
                        ...this.searchFields,
                        page: this.currentPage
                    }
                }).then(response => {
                    const {items, total, per_page, current_page} = response.data;
                    this.itemList = items;
                    this.total = total;
                    this.pageSize = per_page;
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/webapi/item/catlog/getall').then(response => {
                    this.catlogs = response.data.items;
                });
            },
            handleSelectionChange: function (val) {
                this.selectionIds = val;
            },
            handleDelete: function () {
                var items = this.selectionIds.map((d) => d.itemid);
                this.$confirm('此操作将永久删除所选商品, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/webapi/item/delete', {items}).then(response => {
                        this.itemList = this.itemList.filter((d) => {
                            if (_.indexOf(items, d.itemid) === -1) {
                                return d;
                            }
                        });
                    });
                });
            },
            handlerPageChange: function (page) {
                this.currentPage = page;
                this.fetchList();
            },
            handleSearch: function () {
                this.fetchList();
            },
            handleTabClick: function (tab) {
                this.searchFields.tab = tab.name;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
