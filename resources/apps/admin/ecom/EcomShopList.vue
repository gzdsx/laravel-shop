<template>
    <div>
        <header class="page-header">
            <div class="page-title">店铺管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="dsxui-form-inline">
                    <div class="form-item">
                        <div class="form-item-label">店铺名称</div>
                        <el-input size="medium" class="w200" clearable v-model="searchFields.shop_name"></el-input>
                    </div>
                    <div class="form-item">
                        <div class="form-item-label">店主ID</div>
                        <el-input size="medium" class="w200" clearable v-model="searchFields.seller_id"></el-input>
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
                        <el-tab-pane label="正常" name="1"></el-tab-pane>
                        <el-tab-pane label="等待审核" name="0"></el-tab-pane>
                        <el-tab-pane label="审核不过" name="2"></el-tab-pane>
                    </el-tabs>
                </div>
                <el-table :data="items" style="width: 100%" v-loading="loading"
                          @selection-change="handleSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column label="Logo" width="70">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">
                                <img :src="scope.row.logo" class="img-50 img-round">
                            </a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="shop_name" label="店铺名称"/>
                    <el-table-column prop="seller.username" width="120px" label="店主"></el-table-column>
                    <el-table-column prop="auth_state_des" width="100px" label="认证状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="创建时间"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <a @click="handleShowDetail(scope.row)">详情</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length === 0" @click="handleDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="handleBatchUpdate({auth_state:1})">审核通过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="handleBatchUpdate({auth_state:2})">审核不过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="handleBatchUpdate({closed:1})">批量关闭
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="handleBatchUpdate({closed:0})">批量开启
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next,total"
                            :total="total"
                            :page-size="pageSize"
                            :current-page="page"
                            @current-change="handlePageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
        <el-dialog title="店铺详情" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <el-form class="description-form" label-width="90px">
                <h3>基本信息</h3>
                <el-form-item label="店铺Logo:">
                    <el-image :src="shop.logo" class="img-60"/>
                </el-form-item>
                <el-form-item label="店铺名称:">{{shop.shop_name}}</el-form-item>
                <el-form-item label="客服电话:">{{shop.tel}}</el-form-item>
                <el-form-item label="店主账号:" v-if="shop.seller">{{shop.seller.username}}</el-form-item>
                <el-form-item label="经营地址:">{{shop.formatted_address}}</el-form-item>
                <h3>认证信息</h3>
                <template v-if="shop.certify">
                    <el-form-item label="店主姓名:">{{shop.certify.name}}</el-form-item>
                    <el-form-item label="证件号码:">{{shop.certify.id_card_no}}</el-form-item>
                    <el-form-item label="认证照片:">
                        <a :href="shop.certify.license_pic" target="_blank">
                            <el-image :src="shop.certify.license_pic" class="img-80"/>
                        </a>
                        <a :href="shop.certify.id_card_front" target="_blank">
                            <el-image :src="shop.certify.id_card_front" class="img-80"/>
                        </a>
                        <a :href="shop.certify.id_card_back" target="_blank">
                            <el-image :src="shop.certify.id_card_back" class="img-80"/>
                        </a>
                        <a :href="shop.certify.id_card_hand" target="_blank">
                            <el-image :src="shop.certify.id_card_hand" class="img-80"/>
                        </a>
                        <a :href="shop.certify.other_pic" target="_blank" v-if="shop.certify.other_pic">
                            <el-image :src="shop.certify.other_pic" class="img-80"/>
                        </a>
                    </el-form-item>
                </template>
                <el-form-item>
                    <el-button @click="handleVerify(2)">审核不过</el-button>
                    <el-button type="primary" @click="handleVerify(1)">审核通过</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "EcomShopList",
        data() {
            return {
                items: [],
                total: 0,
                page: 1,
                pageSize: 15,
                selectionIds: [],
                searchFields: {
                    shop_name: '',
                    seller_id: '',
                    closed: '',
                    certify_state:''
                },
                loading: true,
                nodes: [],
                showDialog: false,
                shop: {}
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                let {page, pageSize, searchFields} = this;
                let offset = (page - 1) * pageSize;
                this.loading = true;
                this.$get('/ecom/shop/list', {
                    ...searchFields,
                    offset,
                    sort: 'time-desc'
                }).then(response => {
                    const {items, total} = response.result;
                    this.total = total;
                    this.items = items;
                    this.loading = false;
                });
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleDelete() {
                var items = this.selectionIds.map((d) => d.shop_id);
                this.$confirm('此操作将永久删除所选商品, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/shop/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlePageChange(page) {
                this.page = page;
                this.fetchList();
            },
            handleSearch() {
                this.page = 1;
                this.fetchList();
            },
            handleTabClick(tab) {
                if (tab.name === 'all') {
                    this.searchFields.certify_state = '';
                } else {
                    this.searchFields.certify_state = tab.name;
                }
                this.page = 1;
                this.fetchList();
            },
            handleBatchUpdate(data) {
                var items = this.selectionIds.map((d) => d.shop_id);
                this.$post('/ecom/shop/batchupdate', {items, data}).then(response => {
                    this.fetchList();
                });
            },
            handleShowDetail(d) {
                this.shop = d;
                this.showDialog = true;
            },
            handleVerify(auth_state) {
                let {shop_id} = this.shop;
                this.$post('/ecom/shop/verify', {shop_id, auth_state}).then(() => {
                    this.shop.auth_state = auth_state;
                    this.showDialog = false;
                    this.$showToast('请求已受理');
                });
            }
        }
    }
</script>

<style scoped>

</style>
