<template>
    <loading-view v-if="loading"/>
    <div class="dealer-home" v-else>
        <div class="dealer-home-header">
            <div class="dealer-avatar">
                <van-image :src="userInfo.avatar" width="64" height="64" round/>
            </div>
            <div class="flex-fill flex-column justify-content-center">
                <div class="dealer-home">{{userInfo.username}}</div>
                <div class="dealer-grade">一级分销商</div>
            </div>
        </div>
        <van-cell-group>
            <van-cell
                    title="我的下线"
                    size="large"
                    center
                    is-link
                    to="/fenxiao/subordinate"
            />
            <van-cell
                    title="推广海报"
                    size="large"
                    center
                    is-link
                    to="/fenxiao/dealer-poster"
            />
        </van-cell-group>
    </div>
</template>

<script>
    export default {
        name: "DealerHome",
        data() {
            return {
                loading: true,
                dealer: {}
            }
        },
        computed: {
            userInfo() {
                return this.$store.state.userInfo;
            }
        },
        methods: {
            fetchData() {
                let {uid} = this.$store.state.userInfo;
                this.$get('/user/dealer.info', {uid}).then(response => {
                    this.dealer = response.result;
                    this.loading = false;
                });
            }
        },
        mounted() {
            this.fetchData();
        }
    }
</script>

<style scoped>

</style>
