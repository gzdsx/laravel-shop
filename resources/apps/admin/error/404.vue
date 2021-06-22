<template>
<div>
    <div class="image">
        <img src="/images/common/404.png">
    </div>
    <h2>咦，你要找的页面不见了！</h2>
    <div class="links">
        <router-link to="/">返回首页</router-link>
        <router-link to="">返回上一页</router-link>
    </div>
</div>
</template>

<script>
    export default {
        name: "404",
    }
</script>

<style scoped>

</style>
