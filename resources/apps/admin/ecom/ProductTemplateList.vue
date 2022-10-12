<template>
    <div>
        <header class="page-header">
            <div class="page-title">运费模板</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <div class="table-edit-title">模板列表</div>
                    <div class="buttons-wrapper">
                        <router-link to="/product/template/edit">
                            <el-button type="primary" size="small">添加模板</el-button>
                        </router-link>
                    </div>
                </div>

                <el-table :data="dataList">
                    <el-table-column prop="template_name" label="模板名称" width="200"/>
                    <el-table-column label="模板介绍">
                        <template slot-scope="scope">
                            <p>
                                {{scope.row.start_quantity}}件内{{scope.row.start_fee}}元;每增加{{scope.row.growth_quantity}}件{{scope.row.growth_fee}}元</p>
                            <p>{{scope.row.free_quantity}}件以上包邮或者金额满{{scope.row.free_amount}}包邮</p>
                        </template>
                    </el-table-column>
                    <el-table-column width="90" label="操作选项" align="right">
                        <template slot-scope="scope">
                            <router-link :to="'/product/template/edit?template_id='+scope.row.template_id">编辑
                            </router-link>
                            <a @click="onDelete(scope.row.template_id)">删除</a>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductTemplateList",
        data() {
            return {
                dataList: [],
            }
        },
        methods: {
            fetchList() {
                this.$get('/ecom/product.template.getList').then(response => {
                    this.dataList = response.result.items;
                });
            },
            onDelete(template_id) {
                this.$confirm('此操作将永久删除所选模板, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/product.template.delete', {template_id}).then(() => {
                        this.fetchList();
                    });
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
