<template>
    <main-layout>
        <h2 slot="header">页面管理</h2>
        <section class="page-section">
            <el-table :data="dataList" @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column prop="id" label="ID" width="60"/>
                <el-table-column prop="title" label="页面标题">
                    <template slot-scope="scope">
                        <a :href="scope.row.url" target="_blank">{{ scope.row.title }}</a>
                    </template>
                </el-table-column>
                <el-table-column prop="name" label="别名"/>
                <el-table-column prop="user.nickname" width="170" label="作者"/>
                <el-table-column prop="created_at" width="170" label="发布时间"/>
                <el-table-column width="100" align="right" label="选项">
                    <template slot-scope="scope">
                        <router-link :to="'/page/edit/'+scope.row.id">编辑</router-link>
                        <span>|</span>
                        <a :href="scope.row.url" target="_blank">浏览</a>
                    </template>
                </el-table-column>
            </el-table>
            <div class="table-edit-footer">
                <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                    批量删除
                </el-button>
                <div class="flex"></div>
            </div>
        </section>
    </main-layout>
</template>

<script>
export default {
    name: "PageList",
    data() {
        return {
            dataList: [],
            selectionIds: []
        }
    },
    methods: {
        fetchList() {
            this.$get('/pages').then(response => {
                this.dataList = response.result.items;
            });
        },
        onSelectionChange(val) {
            this.selectionIds = val;
        },
        onDelete() {
            let ids = this.selectionIds.map((d) => d.id);
            this.$confirm('此操作将永久删除所选页面, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/page/delete', {ids}).then(() => {
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
