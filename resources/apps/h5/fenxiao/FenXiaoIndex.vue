<template>
    <loading-view v-if="loading"/>
    <div class="container" v-else>
        <dealer-home v-if="isDealer"/>
        <dealer-enroll v-else/>
    </div>
</template>

<script>
    import DealerHome from "./DealerHome";
    import DealerEnroll from "./DealerEnroll";

    export default {
        name: "FenXiaoIndex",
        components: {DealerEnroll, DealerHome},
        data() {
            return {
                loading: true,
                isDealer: false
            }
        },
        mounted() {
            this.$get('/user/dealer.check').then(response => {
                this.isDealer = response.result;
                this.loading = false;
            });
        }
    }
</script>

<style scoped>

</style>
