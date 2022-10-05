<template>
    <div>
        <van-cell-group>
            <van-cell title="登录密码" is-link size="large" to="/security/password"></van-cell>
            <van-cell title="支付密码" is-link size="large" to="/security/paymentpwd"></van-cell>
            <van-cell title="绑定手机" :value="auth.userinfo.mobile ? '已绑定' : '未绑定'" is-link size="large"
                      to="/security/mobile"></van-cell>
            <van-cell title="绑定邮箱" :value="auth.userinfo.email ? '已绑定' : '未绑定'" is-link size="large"
                      to="/security/email"></van-cell>
        </van-cell-group>

        <van-tabbar>
            <van-button block type="danger" class="h50" url="/signout">退出登录</van-button>
        </van-tabbar>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        name: "SecurityApp",
        data() {
            return {}
        },
        computed: {
            ...mapState(['auth'])
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
