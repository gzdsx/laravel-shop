<template>
    <div>
        <header class="page-header">
            <div class="page-title">商品管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">产品名称</div>
                        <el-input size="medium" class="w200" clearable v-model="params.title"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">产品ID</div>
                        <el-input size="medium" class="w200" clearable v-model="params.itemid"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">目录分类</div>
                        <div class="form-item-input">
                            <el-cascader
                                    :options="nodes"
                                    size="medium"
                                    class="w200"
                                    @change="onCascaderChange"
                                    :clearable="true"
                                    style="height: 36px;"
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
                        <el-tab-pane label="出售中" name="onSale"></el-tab-pane>
                        <el-tab-pane label="已下架" name="offShelf"></el-tab-pane>
                        <el-tab-pane label="已售罄" name="soldOut"></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/product/edit" target="_blank">
                            <el-button type="primary" size="small">添加商品</el-button>
                        </router-link>
                    </div>
                </div>
                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <a :href="'/#'+scope.row.m_url" target="_blank">
                                <el-image :src="scope.row.thumb" fit="cover" class="img-60"/>
                            </a>
                        </template>
                    </el-table-column>
                    <el-table-column label="产品名称">
                        <template slot-scope="scope">
                            <div><a :href="scope.row.url" target="_blank">{{scope.row.title}}</a></div>
                            <p v-if="scope.row.shop">
                                <a :href="scope.row.shop.url" target="_blank" style="font-size: 12px;color: #838383;">
                                    {{scope.row.shop.shop_name}}</a>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="price" width="100" label="单价"/>
                    <el-table-column prop="sold" width="80" label="销量"/>
                    <el-table-column prop="state_des" width="80" label="状态"/>
                    <el-table-column prop="created_at" width="170" label="上架时间"/>
                    <el-table-column width="50" label="选项" align="right">
                        <template slot-scope="scope">
                            <router-link :to="'/product/edit/'+scope.row.itemid" target="_blank">编辑
                            </router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length === 0" @click="onDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="onBatchUpdate({state:1})">批量上架
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="onBatchUpdate({state:0})">批量下架
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next,total"
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
        name: "ProductList",
        mixins: [PaginationMixin],
        data() {
            return {
                listApi: '/ecom/product.getList',
                params: {
                    title: '',
                    cate_id: '',
                    itemid: '',
                    tab: '',
                    cates: [],
                    sort: 'time-desc'
                },
                nodes: [],
            }
        },
        methods: {
            fetchCategoryList() {
                this.$get('/ecom/product.category.getList').then(response => {
                    this.nodes = this.serilazeProps(response.result.items);
                });
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.itemid);
                this.$confirm('此操作将永久删除所选商品, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/product.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                this.params.tab = tab.name;
                this.onSearch();
            },
            onBatchUpdate(data) {
                let ids = this.selectionIds.map((d) => d.itemid);
                this.$post('/ecom/product.batchUpdate', {ids, data}).then(() => {
                    this.fetchList();
                });
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
            onCascaderChange(v) {
                this.params.cate_id = v[v.length - 1];
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
