<template>
    <div>
        <header class="page-header">
            <div class="page-title">商品型号</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>型号分类</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd">添加分类</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="dataList">
                    <el-table-column label="型号分类" prop="attr_title" width="200"/>
                    <el-table-column label="型号" prop="values"/>
                    <el-table-column label="选项" width="170" align="right">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                            <span>|</span>
                            <a @click="onDelete(scope.row.attr_cate_id)">删除</a>
                            <span>|</span>
                            <router-link :to="'/ecom/product-attrvalue?attr_cate_id='+scope.row.attr_cate_id">型号管理
                            </router-link>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
        <el-dialog
                title="提示"
                :visible.sync="showDialog"
                width="40%"
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                closeable
        >
            <el-form label-width="80px" class="w400">
                <el-form-item label="分类名称">
                    <el-input v-model="attr.attr_title"/>
                </el-form-item>
                <el-form-item>
                    <el-button size="medium" type="primary" @click="onSubmit">确 定</el-button>
                    <el-button size="medium" @click="showDialog = false">取 消</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "ProductModel",
        data() {
            return {
                attr: {},
                dataList: [],
                showDialog: false
            }
        },
        methods: {
            fetchList() {
                this.$get('/ecom/product.attr.getList').then(response => {
                    this.dataList = response.result.items.map(item => {
                        item.values = item.attr_values.map(val => val.attr_value).join('；') + '；';
                        return item;
                    });
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(c) {
                this.attr = c;
                this.showDialog = true;
            },
            onDelete(attr_cate_id) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/product.attr.delete', {attr_cate_id}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {attr} = this;
                if (!attr.attr_title) {
                    this.$showToast('请填写属性名称');
                    return false;
                }

                let {attr_cate_id} = attr;
                this.$post('/ecom/product.attr.save', {attr_cate_id, attr}).then(() => {
                    this.resetData();
                    this.fetchList();
                    this.showDialog = false;
                });
            },
            resetData() {
                this.attr = {
                    attr_cate_id: 0,
                    attr_title: ''
                }
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
