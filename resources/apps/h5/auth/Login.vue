<template>
    <div class="sign-container">
        <div class="sign-content">
            <!--            <div class="sign-logo">-->
            <!--                <img src="/images/app/appicon.png" alt=""/>-->
            <!--            </div>-->
            <div class="sign-header">
                <h1>密码登录</h1>
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
            <div class="policy-tip">
                <div class="flex-fill">
                    <input type="checkbox" style="vertical-align: -2px;" v-model="agreement">
                    <span>登录即代表您已同意我们的<a href="/h5/page/36.html" target="_blank">隐私政策</a></span>
                </div>
                <div>
                    <a @click="showVerCodeLogin">验证码登录</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {OauthClientId, OauthClientSecret} from "../config";
    import {LOGIN} from "../vuex/types";

    export default {
        name: "Login",
        data() {
            return {
                account: '',
                password: '',
                agreement: true
            }
        },
        computed: {
            disabled() {
                return !(this.account.length > 2 && this.password.length > 5);
            }
        },
        methods: {
            submit() {
                let {account, password} = this;
                if (!account) {
                    this.$toast.fail('请输入登录账号');
                    return false;
                }

                if (!password) {
                    this.$toast.fail('请输入登录密码');
                    return false;
                }

                if (!this.agreement) {
                    this.$toast.fail('请先同意我们的隐私政策');
                    return false;
                }

                this.$axios.post('/oauth/token', {
                    'grant_type': 'password',
                    'client_id': OauthClientId,
                    'client_secret': OauthClientSecret,
                    'username': account,
                    'password': password,
                    'scope': '*',
                }).then(response => {
                    const {access_token} = response.data;
                    if (access_token) {
                        localStorage.setItem('accessToken', access_token);
                        this.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
                        this.$get('/user/info').then(response => {
                            this.$store.commit(LOGIN, response.result.userInfo);
                        });
                        this.$router.go(-1);
                    }
                }).catch(reason => {
                    this.$toast.fail('您输入的账号和密码不匹配');
                });
            },
            showVerCodeLogin() {
                this.$router.replace('/ver_code_login');
            }
        }
    }
</script>

<style scoped>

</style>
