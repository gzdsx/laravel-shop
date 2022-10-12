<template>
    <div>
        <header class="page-header">
            <div class="page-title">门店管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="onClickTab" value="all">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane label="营业中" name="0"></el-tab-pane>
                        <el-tab-pane label="已关闭" name="1"></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <router-link to="/shop/edit">
                            <el-button type="primary" size="small">添加门店</el-button>
                        </router-link>
                    </div>
                </div>
                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column label="Logo" width="70">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">
                                <img :src="scope.row.logo" class="img-50 img-round">
                            </a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="shop_name" label="店铺名称"/>
                    <el-table-column prop="seller.nickname" width="120px" label="店主"></el-table-column>
                    <el-table-column prop="state_des" width="120px" label="店铺状态"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="创建时间"></el-table-column>
                    <el-table-column width="50" label="选项" align="right">
                        <template slot-scope="scope">
                            <router-link :to="'/shop/edit/'+scope.row.shop_id">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length === 0" @click="onDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="onBatchUpdate({closed:1})">批量关闭
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="onBatchUpdate({closed:0})">批量开启
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
                    <el-button @click="onVerify(2)">审核不过</el-button>
                    <el-button type="primary" @click="onVerify(1)">审核通过</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "ShopList",
        mixins: [PaginationMixin],
        data() {
            return {
                nodes: [],
                shop: {},
                showDialog: false,
                listApi: '/ecom/shop.getList',
                params: {
                    closed: ''
                }
            }
        },
        methods: {
            onDelete() {
                let ids = this.selectionIds.map((d) => d.shop_id);
                this.$confirm('此操作将永久删除所选商品, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/shop.batchDelete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onClickTab(tab) {
                if (tab.name === 'all') {
                    this.params.closed = '';
                } else {
                    this.params.closed = tab.name;
                }
                this.onSearch();
            },
            onBatchUpdate(data) {
                let ids = this.selectionIds.map((d) => d.shop_id);
                this.$post('/ecom/shop.batchUpdate', {ids, data}).then(response => {
                    this.fetchList();
                });
            },
            onShowDetail(d) {
                this.shop = d;
                this.showDialog = true;
            },
            onVerify(auth_state) {
                let {shop_id} = this.shop;
                this.$post('/ecom/shop.verify', {shop_id, auth_state}).then(() => {
                    this.shop.auth_state = auth_state;
                    this.showDialog = false;
                    this.$showToast('请求已受理');
                });
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
