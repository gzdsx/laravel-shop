<template>
<admin-frame>
    <div class="image">
        <img src="/images/common/404.png">
    </div>
    <h2>咦，你要找的页面不见了！</h2>
    <div class="links">
        <router-link to="/">返回首页</router-link>
        <router-link to="">返回上一页</router-link>
    </div>
</admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    export default {
        name: "404",
        components:{
            AdminFrame
        }
    }
</script>

<style scoped>

</style>
