<template>
    <div id="app">
        <router-view :key="$route.fullPath"/>
    </div>
</template>

<script>
    import {LOGIN} from "../vuex/types";

    export default {
        name: "App",
        mounted() {
            this.$get('/user/info').then(response => {
                this.$store.commit(LOGIN, response.result);
            });
        }
    }
</script>

<style scoped>

</style>
