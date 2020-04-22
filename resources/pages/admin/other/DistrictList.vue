<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>区域管理</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    export default {
        name: "DistrictList",
        components:{
            AdminFrame
        }
    }
</script>

<style scoped>

</style>
