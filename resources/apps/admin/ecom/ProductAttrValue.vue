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
                            <span>型号分类:{{attr.attr_title}}</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd">添加型号</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="attr.attr_values">
                    <el-table-column label="型号" prop="attr_value"/>
                    <el-table-column label="选项" width="100">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                            <span>|</span>
                            <a @click="onDelete(scope.row.attr_id)">删除</a>
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
                    <el-input v-model="attr_value.attr_value"/>
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
        name: "EcomProductAttrValue",
        data() {
            return {
                attr: {},
                attr_value: {},
                showDialog: false,
            }
        },
        methods: {
            fetchList() {
                let {attr_cate_id} = this.$route.query;
                this.$get('/ecom/product.attrvalue.getList', {attr_cate_id}).then(response => {
                    this.attr = response.result;
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(c) {
                this.attr_value = c;
                this.showDialog = true;
            },
            onDelete(attr_id) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/product.attrvalue.delete', {attr_id}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {attr_value} = this;
                if (!attr_value.attr_value) {
                    this.$showToast('请填写型号名称');
                    return false;
                }

                let {attr_id} = attr_value;
                this.$post('/ecom/product.attrvalue.save', {attr_id, attr_value}).then(() => {
                    this.resetData();
                    this.fetchList();
                    this.showDialog = false;
                });

            },
            resetData() {
                let {attr_cate_id} = this.$route.query;
                this.attr_value = {
                    attr_cate_id,
                    attr_value: '',
                    attr_id: 0
                }
            }
        },
        mounted() {
            this.attr_cate_id = this.$route.query.attr_cate_id;
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
