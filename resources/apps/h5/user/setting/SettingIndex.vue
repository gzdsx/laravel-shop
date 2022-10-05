<template>
    <div class="container">
        <van-cell-group>
            <van-cell
                    title="个人资料"
                    size="large"
                    is-link
                    center
                    to="/user/profile"
            />
            <van-cell
                    title="收货地址"
                    size="large"
                    is-link
                    center
                    to="/user/address"
            />
            <van-cell
                    title="登录密码"
                    size="large"
                    is-link
                    center
                    to="/security/password"
            />
            <van-cell
                    title="支付密码"
                    size="large"
                    is-link
                    center
                    to="/security/paymentpassword"
            />
        </van-cell-group>
        <div class="login-out" @click="logOut">退出登录</div>
    </div>
</template>

<script>
    export default {
        name: "SettingIndex",
        methods: {
            logOut() {
                localStorage.removeItem('accessToken');
                this.$router.replace('/login');
            }
        },
        mounted() {
            this.setBackgroundColor('#f5f5f5');
        }
    }
</script>

<style scoped>
    .van-cell--large {
        padding-top: 16px;
        padding-bottom: 16px;
    }

    .login-out {
        margin-top: 30px;
        background-color: #fff;
        font-size: 16px;
        text-align: center;
        padding: 15px;
    }
</style>
