<template>
    <div>
        <van-cell-group>
            <van-field
                    v-model="mobile"
                    type="tel"
                    placeholder="请输入手机号"
                    size="large"
                    @input="onMobileChange"
                    class="van-field-large"
            >
            </van-field>
            <van-field
                    v-model="code"
                    type="text"
                    placeholder="请输入验证码"
                    size="large"
                    class="van-field-large"
            >
                <template #button>
                    <van-button size="small" type="info" :disabled="disabled1" @click="sendCode">
                        {{btnTitle}}
                    </van-button>
                </template>
            </van-field>
        </van-cell-group>
        <div style="margin: 30px 16px;">
            <van-button block type="info" :disabled="disabled" @click="onSubmit">
                提交
            </van-button>
        </div>
    </div>
</template>

<script>

    export default {
        name: "BindMobile",
        data() {
            return {
                mobile: '',
                code: '',
                btnTitle: '获取验证码',
                interval: null,
                disabled1: true
            }
        },
        computed: {
            disabled() {
                return !(this.mobile.length === 11 && this.code.length > 0);
            },
        },
        mounted() {

        },
        methods: {
            sendCode() {
                const phone = this.mobile;
                this.$post('/sms/sendcode', {phone}).then(response => {
                    this.$toast.success('验证码已成功发送');
                    this.disabled1 = true;
                    let timer = 60;
                    this.interval = setInterval(() => {
                        if (timer < 1) {
                            this.disabled1 = false;
                            this.btnTitle = '获取验证码';
                            clearInterval(this.interval);
                        } else {
                            this.btnTitle = timer + '秒后重新获取';
                        }
                        timer--;
                    }, 1000);
                });
            },
            onSubmit() {
                const mobile = this.mobile;
                const code = this.code;

                if (!this.$validator.isMobile(mobile)) {
                    this.$toast.fail('手机号输入不正确');
                    return false;
                }

                if (!code) {
                    this.$toast.fail('请输入验证码');
                    return false;
                }

                this.$post('/security/mobile/update', {mobile, code}).then(response => {
                    this.$toast.success({
                        message: '手机绑定成功',
                        onClose: function () {
                            window.history.back();
                        }
                    })
                }).catch(reason => {
                    this.$toast.fail(reason.data.errmsg);
                });
            },
            onMobileChange(e) {
                this.disabled1 = this.mobile.length !== 11;
            }
        }
    }
</script>

<style scoped>

</style>
