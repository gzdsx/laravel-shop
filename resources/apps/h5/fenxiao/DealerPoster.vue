<template>
    <loading-view v-if="loading"/>
    <div class="container" v-else>
        <div class="flex-row justify-content-center">
            <img :src="src" :style="{'width':'100%'}"/>
        </div>
    </div>
</template>

<script>
    import LoadingView from "../common/LoadingView";

    export default {
        name: "DealerPoster",
        components: {LoadingView},
        data() {
            return {
                src: null,
                loading: true
            }
        },
        mounted() {
            this.$get('/user/dealer.poster').then(response => {
                this.src = response.result + '?' + Math.random();
                this.loading = false;
            });
        }
    }
</script>

<style scoped>

</style>
