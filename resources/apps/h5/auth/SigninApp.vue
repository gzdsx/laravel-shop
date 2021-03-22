<template>
    <div class="sign-container">
        <div class="sign-content">
            <div class="sign-logo">
                <img src="/images/app/appicon.png" alt=""/>
            </div>
            <div class="sign-form">
                <van-field
                    type="tel"
                    class="van-field-large"
                    placeholder="请输入手机号"
                    v-model="account"
                />
                <van-field
                        type="password"
                        class="van-field-large"
                        placeholder="请输入登录密码"
                        v-model="password"
                />
                <div class="button-container">
                    <van-button type="danger" round block :disabled="disabled" @click="submit">登录</van-button>
                </div>
            </div>
            <div class="quick-button">
                <p class="flex-fill"><a>忘记密码</a></p>
                <p><a href="/signup">免费注册</a></p>
            </div>
            <div class="quick-login">
                <div class="quick-login-title">
                    <div class="strik"></div>
                    <h4>其他方式登录</h4>
                </div>
                <div class="quick-type">
                    <a href="/wechat/login">
                        <i class="iconfont icon-wechat-fill"></i>
                        <span>微信</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SigninApp",
        data() {
            return {
                account: '',
                password: ''
            }
        },
        computed: {
            disabled() {
                return !(this.account.length > 2 && this.password.length > 5);
            }
        },
        methods: {
            submit() {
                if (!this.account) {
                    this.$showToast('请输入登录账号');
                    return false;
                }

                if (!this.password) {
                    this.$showToast('请输入登录密码');
                    return false;
                }

                this.$post('/signin', {
                    account: this.account,
                    password: this.password
                }).then(response => {
                    window.location.href = window.pageConfig.redirect;
                }).catch(reason => {
                    this.$showToast(reason.data.errmsg);
                })
            }
        }
    }
</script>

<style scoped>

</style>
