<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">运费模板</h2>
            <div>
                <router-link to="/product/template/edit">
                    <el-button type="primary" size="small">添加模板</el-button>
                </router-link>
            </div>
        </div>

        <section class="page-section">
            <el-table :data="dataList">
                <el-table-column prop="template_name" label="模板名称" width="200"/>
                <el-table-column label="模板介绍">
                    <template slot-scope="scope">
                        <div>
                            {{scope.row.start_quantity}}件内{{scope.row.start_fee}}元;每增加{{scope.row.growth_quantity}}件{{scope.row.growth_fee}}元
                        </div>
                        <div>{{scope.row.free_quantity}}件以上包邮或者金额满{{scope.row.free_amount}}包邮</div>
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
        </section>
    </main-layout>
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
