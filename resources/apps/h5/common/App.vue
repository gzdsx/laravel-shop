<template>
    <div id="app">
        <router-view :key="$route.fullPath"/>
    </div>
</template>

<script>
    export default {
        name: "App",
        mounted() {
            this.$get('/user/info').then(response => {
                this.$store.commit('signin', response.data.userinfo);
            });
        }
    }
</script>

<style scoped>

</style>
