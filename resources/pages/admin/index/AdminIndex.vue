<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>后台管理</el-breadcrumb-item>
                <el-breadcrumb-item>仪表板</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    export default {
        name: "AdminIndex",
        components:{
            AdminFrame
        }
    }
</script>

<style scoped>

</style>
