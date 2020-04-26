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
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">产品名称</div>
                        <el-input size="medium" class="w200" clearable v-model="searchFields.title"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">产品ID</div>
                        <el-input size="medium" class="w200" clearable v-model="searchFields.itemid"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">目录分类</div>
                        <div class="form-item-input">
                            <el-cascader
                                    :options="nodes"
                                    size="medium"
                                    class="w200"
                                    @change="handleCascaderChange"
                                    :clearable="true"
                                    style="height: 36px;"
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
                <el-table :data="itemList" style="width: 100%" v-loading="loading"
                          @selection-change="handleSelectionChange">
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
                    <el-button size="small" type="primary" :disabled="selectionIds.length === 0" @click="handleDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0" @click="handleOnSale">批量上架</el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0" @click="handleOffShelf">批量下架
                    </el-button>
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
                offset: 0,
                pageSize: 15,
                selectionIds: [],
                searchFields: {
                    title: '',
                    catid: '',
                    itemid: '',
                    tab: ''
                },
                loading: true,
                nodes: []
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList: function () {
                this.loading = true;
                this.$axios.get('/admin/item/batchget', {
                    params: {
                        ...this.searchFields,
                        offset: this.offset
                    }
                }).then(response => {
                    const {items, total} = response.data;
                    this.itemList = items;
                    this.total = total;
                    this.loading = false;
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/admin/item/catlog/getall').then(response => {
                    this.nodes = this.serilazeProps(response.data.items);
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
                    this.$axios.post('/admin/item/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch: function () {
                this.offset = 0;
                this.fetchList();
            },
            handleTabClick: function (tab) {
                this.searchFields.tab = tab.name;
                this.offset = 0;
                this.fetchList();
            },
            handleOnSale() {
                var items = this.selectionIds.map((d) => d.itemid);
                this.$axios.post('/admin/item/batchupdate', {
                    items,
                    params: {on_sale: 1}
                }).then(response => {
                    this.fetchList();
                });
            },
            handleOffShelf() {
                var items = this.selectionIds.map((d) => d.itemid);
                this.$axios.post('/admin/item/batchupdate', {
                    items,
                    params: {on_sale: 0}
                }).then(response => {
                    this.fetchList();
                });
            },
            serilazeProps: function (arr) {
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
            handleCascaderChange(v) {
                this.searchFields.catid = v[1];
            }
        }
    }
</script>

<style scoped>

</style>
