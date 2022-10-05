<template>
    <div class="container">
        <div v-if="step===1">
            <van-cell-group>
                <van-field
                        label="+86"
                        label-width="50px"
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
                    <van-button slot="button" size="small" type="warning" :disabled="disabled1" @click="sendCode">
                        {{btnTitle}}
                    </van-button>
                </van-field>
            </van-cell-group>
            <div class="van-cell-button-container">
                <van-button type="warning" block :disabled="disabled2" @click="onVerify">下一步</van-button>
            </div>
        </div>
        <div v-else>
            <van-cell-group>
                <van-field
                        v-model="password"
                        type="password"
                        label="支付密码"
                        placeholder="请输入6位数字密码"
                        size="large"
                        :maxlength="6"
                        class="van-field-large"
                />
                <van-field
                        v-model="password_confirm"
                        type="password"
                        label="确认密码"
                        placeholder="请再次输入支付密码"
                        size="large"
                        :maxlength="6"
                        class="van-field-large"
                />
                <div class="blank-20"></div>
                <van-cell :border="false">
                    <van-button block type="warning" :disabled="disabled" @click="onSubmit">
                        提交
                    </van-button>
                </van-cell>
            </van-cell-group>
        </div>
    </div>
</template>

<script>

    export default {
        name: "ResetPaymentPassword",
        data() {
            return {
                password: '',
                password_confirm: '',
                step: 1,
                phone: '',
                code: '',
                btnTitle: '获取验证码',
                sending: false
            }
        },
        computed: {
            disabled() {
                return !(this.password.length === 6 && this.password_confirm === this.password);
            },
            disabled1() {
                return (this.phone.length !== 11 || this.sending === true);
            },
            disabled2() {
                return !(this.phone.length === 11 && this.code.length === 6);
            },
        },
        methods: {
            onSubmit() {
                const {password, password_confirm} = this;

                if (!/^.{6,20}$/.test(password)) {
                    this.$toast.fail('密码输入不正确');
                    return false;
                }

                if (!password_confirm) {
                    this.$toast.fail('请再次输入支付密码');
                    return false;
                }

                if (password !== password_confirm) {
                    this.$toast.fail('两次密码输入不一致');
                    return false;
                }

                this.$post('/user/account.resetpassword', {password, password_confirm}).then(response => {
                    this.disabled = true;
                    this.$toast.success({
                        message: '支付密码设置成功',
                        onClose: () => {
                            this.$router.go(-1);
                        }
                    })
                });
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
        },
        mounted() {

        },
    }
</script>

<style scoped>

</style>
