<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>运费设置</el-breadcrumb-item>
                <el-breadcrumb-item>模板列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <div class="table-edit-title">模板列表</div>
                    <div class="buttons-wrapper">
                        <router-link to="/freight/edit">
                            <el-button type="primary" size="small">添加模板</el-button>
                        </router-link>
                    </div>
                </div>

                <el-table :data="items" style="width: 100%">
                    <el-table-column prop="template_name" label="模板名称" width="200"></el-table-column>
                    <el-table-column label="模板介绍">
                        <template slot-scope="scope">
                            <p>{{scope.row.start_quantity}}件内{{scope.row.start_fee}}元;每增加{{scope.row.growth_quantity}}件{{scope.row.growth_fee}}元</p>
                            <p>{{scope.row.free_quantity}}件以上包邮或者金额满{{scope.row.free_amount}}包邮</p>
                        </template>
                    </el-table-column>
                    <el-table-column width="90" label="操作选项">
                        <template slot-scope="scope">
                            <router-link :to="'/freight/edit?template_id='+scope.row.template_id">编辑</router-link>
                            <a @click="handleDelete(scope.row.template_id)">删除</a>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    export default {
        name: "FreightList",
        components:{
            AdminFrame
        },
        data () {
            return {
                items: [],
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList () {
                this.$get('/freighttemplate/getall').then(response => {
                    this.items = response.result.items;
                });
            },
            handleDelete (template_id) {
                this.$confirm('此操作将永久删除所选模板, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/freighttemplate/delete',{template_id}).then(response=>{
                        this.fetchList();
                    });
                });
            }
        }
    }
</script>

<style scoped>

</style>
