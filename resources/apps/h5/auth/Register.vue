<template>
    <div class="sign-container">
        <div class="sign-content">
            <div class="sign-header">
                <h1>快速注册</h1>
                <p>亲，欢迎注册新账号</p>
            </div>
            <div class="sign-form" v-if="step===1">
                <van-field
                        v-model="phone"
                        type="tel"
                        placeholder="请输入手机号"
                        size="large"
                        class="van-field-large"
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
                    <input type="checkbox" style="vertical-align: -2px;" v-model="agreement">
                    <span>注册即代表您已同意我们的<a href="/h5/page/36.html" target="_blank">隐私政策</a></span>
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
    </div>
</template>

<script>
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
                    this.$showToast('请填写昵称');
                    return false;
                }

                if (!this.$validator.isUserName(username)) {
                    this.$showToast('昵称填写错误');
                    return false;
                }

                if (!phone) {
                    this.$showToast('请填写手机号码');
                    return false;
                }

                if (!this.$validator.isMobile(phone)) {
                    this.$showToast('手机号填写错误');
                    return false;
                }

                if (!password) {
                    this.$showToast('请填写登录密码');
                    return false;
                }

                if (!this.$validator.isPassword(password)) {
                    this.$showToast('密码填写错误');
                    return false;
                }

                if (!this.agreement) {
                    this.$showToast('请先同意我们的隐私政策');
                    return false;
                }

                this.$axios.post('/h5/signup', {
                    phone,
                    password,
                    username
                }).then(response => {
                    if (response.data.errCode) {
                        this.$showToast(response.data.errMsg);
                    } else {
                        window.location.href = '/h5/user';
                    }
                }).catch(reason => {
                    this.$showToast(reason.data.errMsg);
                });
            },
            setStep(step) {
                this.step = step;
            },
            sendCode() {
                const {phone} = this;
                if (!this.$validator.isMobile(phone)) {
                    this.$showToast('请输入手机号');
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
                this.$post('/sms/verify', {code, phone}).then(response => {
                    this.step = 2;
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                });
            },
        }
    }
</script>

<style scoped>

</style>
