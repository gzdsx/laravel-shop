<template>
    <div class="sign-container">
        <div class="sign-content">
            <div class="sign-header">
                <h1>验证码登录</h1>
            </div>
            <div class="sign-form" v-if="step===1">
                <van-field
                        v-model="phone"
                        type="tel"
                        placeholder="请输入手机号"
                        size="large"
                        class="van-field-large"
                        label="+86"
                        label-width="40"
                >
                </van-field>
                <van-field
                        v-model="code"
                        type="number"
                        placeholder="请输入验证码"
                        size="large"
                        class="van-field-large"
                >
                    <van-button slot="button" size="small" type="danger" :disabled="disabled1" @click="sendCode">
                        {{btnTitle}}
                    </van-button>
                </van-field>
                <div class="button-container">
                    <van-button type="danger" round block :disabled="disabled2" @click="onVerify">下一步</van-button>
                </div>
                <div class="policy-tip">
                    <div class="flex-fill">
                        <input type="checkbox" style="vertical-align: -2px;" v-model="agreement">
                        <span>登录即代表您已同意我们的<a href="/h5/page/36.html" target="_blank">隐私政策</a></span>
                    </div>
                    <div>
                        <a @click="showPasswordLogin">密码登录</a>
                    </div>
                </div>
            </div>

            <div class="sign-form" v-else>
                <van-field
                        type="text"
                        class="van-field-large"
                        v-model="username"
                        placeholder="怎么称呼您"
                />
                <van-field
                        type="password"
                        class="van-field-large"
                        v-model="password"
                        placeholder="设置登录密码"
                />
                <div class="button-container">
                    <van-button type="danger" round block :disabled="disabled3" @click="submit">注册</van-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {LOGIN} from "../vuex/types";

    export default {
        name: "SignupApp",
        data() {
            return {
                username: '',
                phone: '',
                password: '',
                code: '',
                agreement: true,
                step: 1,
                btnTitle: '获取验证码',
                sending: false
            }
        },
        computed: {
            disabled1() {
                return (this.phone.length !== 11 || this.sending === true);
            },
            disabled2() {
                return !(this.phone.length === 11 && this.code.length === 6);
            },
            disabled3() {
                return !(this.username.length > 0 && this.phone.length === 11 && this.password.length > 5);
            },
        },
        methods: {
            submit() {
                const {username, phone, password} = this;
                if (!username) {
                    this.$toast.fail('请填写昵称');
                    return false;
                }

                if (!this.$validator.isUserName(username)) {
                    this.$toast.fail('昵称填写错误');
                    return false;
                }

                if (!password) {
                    this.$toast.fail('请填写登录密码');
                    return false;
                }

                if (!this.$validator.isPassword(password)) {
                    this.$toast.fail('密码填写错误');
                    return false;
                }

                if (!this.agreement) {
                    this.$toast.fail('请先同意我们的隐私政策');
                    return false;
                }

                this.$post('/user/complete_register', {
                    password,
                    username
                }).then(() => {
                    this.$get('/user/info').then(response => {
                        this.$store.commit(LOGIN, response.result.userInfo);
                        this.$router.go(-1);
                    });
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                });
            },
            setStep(step) {
                this.step = step;
            },
            sendCode() {
                const {phone} = this;
                if (!this.$validator.isMobile(phone)) {
                    this.$toast.fail('请输入手机号');
                    return false;
                }

                if (this.sending) {
                    return;
                } else {
                    this.sending = true;
                }

                this.$post('/sms/sendcode', {phone}).then(response => {
                    let timer = 60;
                    this.interval = setInterval(() => {
                        if (timer < 1) {
                            this.btnTitle = '获取验证码';
                            this.sending = false;
                            clearInterval(this.interval);
                        } else {
                            this.btnTitle = timer + '秒后重新获取';
                        }
                        timer--;
                    }, 1000);
                });
            },
            onVerify() {
                let {code, phone} = this;
                this.$post('/ver_code_login', {code, phone}).then(response => {
                    const {access_token, user} = response.result;
                    if (access_token) {
                        localStorage.setItem('accessToken', access_token);
                        if (user.username) {
                            this.$get('/user/info').then(response => {
                                this.$store.commit(LOGIN, response.result.userInfo);
                                this.$router.go(-1);
                            });

                        } else {
                            this.step = 2;
                        }
                    }

                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                });
            },
            showPasswordLogin() {
                this.$router.replace('/login');
            }
        }
    }
</script>

<style scoped>

</style>
